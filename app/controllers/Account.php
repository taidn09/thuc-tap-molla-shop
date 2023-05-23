<?php
class Account extends Controller
{
    private $data = [];
    private $orderModel = null;
    public function __construct()
    {
        $this->orderModel = new OrderModel();
        if (empty($_SESSION['user'])) {
            echo header("location: /");
        }
    }
    public function index()
    {
        $this->data['subcontent']['controller'] = 'account';
        $this->data['subcontent']['orders'] = $this->orderModel->getUserOrder($_SESSION['user']['userId']);
        $this->data['title'] = 'Tài khoản';
        $this->data['content'] = 'client/pages/account';
        $this->render('layouts/client', $this->data);
    }
    public function update()
    {
        if (!empty($_POST) && !empty($_SESSION['user'])) {
            $userId = $_SESSION['user']['userId'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $province = $_POST['province-is'];
            $district = $_POST['district-is'];
            $ward = $_POST['ward-is'];
            $street = $_POST['street'];
            $userModel = new UserModel();
            $res = $userModel->changeInfo($userId, $fname, $lname, $phone, $province, $district, $ward, $street);
            if (!empty($res)) {
                $_SESSION['user'] = $userModel->getUserById($userId);
                echo json_encode(['status' => 1]);
                return;
            }
            echo json_encode(['status' => 0]);
            return;
        }
    }
    public function cpassword()
    {
        if (!empty($_POST)) {
            $userId = $_SESSION['user']['userId'];
            $password = $_POST['password'];
            $newPassword = $_POST['new-password'];
            $userModel = new UserModel();
            $check = $userModel->checkEnterRightPassword($userId, $password);
            if (empty($check)) {
                echo json_encode(['status' => 0, 'message' => 'Password incorrect...']);
                return;
            } else {
                $res = $userModel->changePassword($userId, $password, $newPassword);
                if (empty($res)) {
                    echo json_encode(['status' => 0, 'message' => '']);
                    return;
                }
                echo json_encode(['status' => 1]);
                return;
            }
        }
    }
    public function odt($id)
    {
        if (!empty($id)) {
            $order = $this->orderModel->getOrderById($id);
            if ($order['userId'] !== $_SESSION['user']['userId']) {
                $this->loadError();
            }
            $detail = $this->orderModel->getOrderDetail($id);
            if (!empty($order)) {
                $this->data['subcontent']['order'] = $order;
                $this->data['subcontent']['detail'] = $detail;
            } else {
                $this->loadError();
            }
            $this->data['subcontent']['controller'] = 'order-details';
            $this->data['title'] = 'Chi tiết đơn hàng';
            $this->data['content'] = 'client/pages/order-details';
            $this->render('layouts/client', $this->data);
        } else {
            $this->loadError();
        }
    }
    public function cancelOrder()
    {

        if (!empty($_POST)) {
            $orderId = $_POST['orderId'];
            $res = $this->orderModel->cancel($orderId);
            $orders = $this->orderModel->getUserOrder($_SESSION['user']['userId']);
            foreach ($orders as $key => $item) {
                $text = $this->orderModel->getStatusById($item['status'])['status_text'];
                $orders[$key]['statusText'] = $text;
            }
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'orders' => $orders
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function returns()
    {
        if (!empty($_POST)) {
            $orderId = trim($_POST['orderId']);
            $optionId = trim($_POST['optionId']);
            $reason = trim($_POST['reason']);
            $image = $_FILES['image'];
            $time = time();
            $check = $this->uploadImage($image,'returns', $time);
            if(empty($check)){
                $new_img_name = md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME)).$time).'.'.strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
                $res = $this->orderModel->updateOrderDetailStatus($orderId,$optionId,1,$reason,$new_img_name);
                if(!empty($res)){
                    echo json_encode([
                        'status' => 1,
                    ]);
                    return;
                }
            }
            
        }
        echo json_encode([
            'status' => 0,
        ]);
        return;
    }
}

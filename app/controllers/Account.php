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
            if (!empty($_FILES['avatar'])) {
                $avatar = $_FILES['avatar'];
                $time = time();
                $check = $this->uploadImage($avatar, 'user', $time);
                if ($check) {
                    echo json_encode([
                        'status' => 0,
                        'uploadErr' => $check
                    ]);
                    return;
                }
                $new_img_name = md5(strtolower(pathinfo(basename($avatar['name']), PATHINFO_FILENAME)) . $time) . '.' . strtolower(pathinfo(basename($avatar['name']), PATHINFO_EXTENSION));
                $res = $userModel->changeInfo($userId, $fname, $lname, $phone, $province, $district, $ward, $street, $new_img_name);
            } else {
                $avatar = null;
                $res = $userModel->changeInfo($userId, $fname, $lname, $phone, $province, $district, $ward, $street, $avatar);
            }
            if (!empty($res)) {
                $user = $userModel->getUserById($userId);
                $_SESSION['user'] = $user;
                $userAvatar = '';
                if (!empty($_SESSION['user']['avatar'])) {
                    if (strstr($_SESSION['user']['avatar'], 'https') !== false) {
                        $userAvatar = $_SESSION['user']['avatar'];
                    } else {
                        $userAvatar = '/public/assets/images/user/' . $_SESSION['user']['avatar'];
                    }
                } else {
                    $userAvatar = '/public/assets/images/user.png';
                }

                echo json_encode(['status' => 1, 'avatar' => $userAvatar]);
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
                echo json_encode(['status' => 0, 'message' => 'Mật khẩu không chính xác...']);
                return;
            } else {
                $res = $userModel->changePassword($userId, $newPassword);
                if ($res !== false) {
                    echo json_encode(['status' => 1]);
                    return;
                }
                echo json_encode(['status' => 0]);
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
            $this->data['subcontent']['controller'] = 'account';
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
            $this->checkUserValid();
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
    public function review($orderId){
        if(!empty($orderId)){
            $orderModel = new OrderModel();
            $order = $orderModel->getOrderById($orderId);
            if($order['rated']== 1){
                echo header('location: /account');
            }
            $detail = $orderModel->getOrderDetail($orderId);
            if(empty($detail)){
                $this->loadError();
            }
            $this->data['subcontent']['controller'] = 'account';
            $this->data['subcontent']['orderId'] = $orderId;
            $this->data['subcontent']['detail'] =  $detail;
            $this->data['title'] = 'Đánh giá sản phẩm';
            $this->data['content'] = 'client/pages/review';
            $this->render('layouts/client', $this->data);
        }else{
            $this->loadError();
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
            $check = $this->uploadImage($image, 'returns', $time);
            if (empty($check)) {
                $new_img_name = md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME)) . $time) . '.' . strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
                $res = $this->orderModel->updateOrderDetailStatus($orderId, $optionId, 1, $reason, $new_img_name);
                if (!empty($res)) {
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

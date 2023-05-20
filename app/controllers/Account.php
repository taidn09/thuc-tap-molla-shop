<?php
class Account extends Controller
{
    private $data = [];
    public function index()
    {
        if (empty($_SESSION['user'])) {
            echo header("location: /");
        }
        $orderModel = new OrderModel();
        $this->data['subcontent']['controller'] = 'account';
        $this->data['subcontent']['orders'] = $orderModel->getUserOrder($_SESSION['user']['userId']);
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

            $orderModel = new OrderModel();
            $order = $orderModel->getOrderById($id);
            if ($order['userId'] !== $_SESSION['user']['userId']) {
                $this->loadError();
            }
            $detail = $orderModel->getOrderDetail($id);
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
}

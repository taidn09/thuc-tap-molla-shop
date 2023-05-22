<?php
class Auth extends Controller
{
    public $data = [];
    public $model = null;
    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function index()
    {
        if (!empty($_SESSION['user'])) {
            echo header("location: /");
        }
        $this->data['title'] = 'Đăng nhập / Đăng ký';
        $this->data['content'] = 'client/pages/auth';
        $this->data['subcontent'] = null;
        $this->render('layouts/client', $this->data);
    }
    public function register()
    {
        $result = $this->model->register($_POST['register-email'], $_POST['register-password']);
        echo json_encode($result);
    }
    public function login()
    {
        $result = $this->model->login($_POST['signin-email'], $_POST['signin-password']);
        if (!empty($result)) {
            $_SESSION['user'] = $result;
        }
        echo json_encode($result);
    }
    public function logout()
    {
        if (!empty($_SESSION['user'])) {
            unset($_SESSION['user']);
            if (!empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            if (!empty($_SESSION['cart-total-amount'])) {
                unset($_SESSION['cart-total-amount']);
            }
            if (!empty($_SESSION['cart-total-quantity'])) {
                unset($_SESSION['cart-total-quantity']);
            }
            echo header("location: /");
        }
    }
    public function generateToken()
    {
        $token = md5(uniqid('molla'));
        $email = trim($_POST['email']);
        $tokenModel = new TokenModel();
        $check = $this->model->checkEmailExisted($email);
        if ($check) {
            $res = $tokenModel->add($email, $token);
            if (!empty($res)) {
                $this->sendEmail($email, "Mã xác nhận thay đổi mật khẩu của bạn là: $token");
                echo json_encode(['status' => 1]);
                return;
            } else {
                echo json_encode(['status' => 0]);
                return;
            }
        } else {
            echo json_encode(['status' => 0, 'errMsg' => 'Email chưa đăng ký tài khoản tại Molla!']);
            return;
        }
    }
    public function forgotPassword()
    {
        $this->data['title'] = 'Quên mật khẩu';
        $this->data['content'] = 'client/pages/forgot-password';
        $this->data['subcontent'] = null;
        $this->render('layouts/client', $this->data);
    }
    public function checkToken()
    {
        $token = trim($_POST['token']);
        $email = trim($_POST['email']);
        $tokenModel = new TokenModel();
        $check = $tokenModel->check($email, $token);
        if (!empty($check)) {
            echo json_encode(['status' => 1]);
            return;
        }
        echo json_encode(['status' => 0, 'errMsg' => 'Mã xác nhận đã hết hạn!']);
        return;
    }
    public function changePassword()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if (!empty($email) && !empty($password)) {
            $this->model->changePasswordByEmail($email, $password);
            echo json_encode(['status' => 1]);
            return;
        }
        echo json_encode(['status' => 0, 'errMsg' => 'Đừng có sửa bậy']);
        return;
    }
}

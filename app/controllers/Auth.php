<?php
class Auth extends Controller
{
    public $data = [];
    public $model = null;
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
        $this->model = new UserModel();
        $result = $this->model->register($_POST['register-email'], $_POST['register-password']);
        echo json_encode($result);
    }
    public function login()
    {
        $this->model = new UserModel();
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
}

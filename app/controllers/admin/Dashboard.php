<?php

class Dashboard extends Controller
{
    private $data = [];
    public function index()
    {
        $this->data['subcontent']['controller'] = 'home';
        $this->data['content'] = 'admin/pages/home';
        $this->render('layouts/admin', $this->data);
    }
    public function login()
    {
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $adminModel = new AdminModel();
            $res = $adminModel->login($email, $password);
            if (!empty($res)) {
                $_SESSION['admin'] = $res;
                $roles = $adminModel->getRoles($_SESSION['admin']['adminId']);
                $values_array = array();
                foreach ($roles as $item) {
                    $values_array[] = $item['roleString'];
                }
                // array_push($values_array,'dashboard');
                if (!empty($values_array) && is_array($values_array)) {
                    $_SESSION['admin']['roles'] = $values_array;
                } else {
                    $_SESSION['admin']['roles'] = array();
                }
                echo json_encode([
                    'status' => 1
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        } else {
            if (!empty($_SESSION['admin'])) {
                echo header("location: /admin/dashboard");
            }
            $this->data['subcontent']['controller'] = 'login';
            $this->data['content'] = 'admin/pages/login';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function logout()
    {
        if (!empty($_SESSION['admin'])) {
            unset($_SESSION['admin']);
            echo header("location: /admin/dashboard/login");
        }
    }
}
<?php
class Contact extends Controller
{
    private $data = [];
    private $model = null;
    public function __construct()
    {
        $this->model = new ContactModel();
    }
    public function index()
    {
        $this->data['subcontent']['controller'] = 'contact';
        $this->data['content'] = 'client/pages/contact';
        $this->render('layouts/client', $this->data);
    }
    public function add()
    {
        if (!empty($_POST)) {
            $this->checkUserValid();
            $userId = $_SESSION['user']['userId'] ?? null;
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $message = trim($_POST['message']);
            $res = $this->model->addContact($name, $userId, $email, $phone, $message);
            if (!empty($res)) {
                echo json_encode(['status' => 1]);
                return;
            }
            echo json_encode(['status' => 0]);
            return;
        }
    }
}

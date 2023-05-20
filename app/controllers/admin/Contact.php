<?php 
    class Contact extends Controller{
        private $model = null;
        private $data = [];
        public function __construct() {
            $this->model = new ContactModel();
        }
        public function index()
        {
            $this->data['title'] = 'Contact';
            $this->data['subcontent']['controller'] = 'contact';
            $this->data['subcontent']['contacts'] = $this->model->getAllContact();
            $this->data['content'] = 'admin/pages/contact/list';
            $this->render('layouts/admin', $this->data);
        }
        public function reply($id = null)
        {
            if (!empty($_POST['id'])) {
                $contactId = $_POST['id'];
                $email = trim($_POST['email']);
                $sendMailStatus = true;
                $reply = trim($_POST['reply']);
                if(!empty($_POST['reply'])){
                    $res = $this->model->reply($contactId,$reply);
                    $sendMailStatus = $this->sendEmail($email, $reply);
                }
                if ($res === false || !$sendMailStatus) {
                    echo json_encode([
                        'status' => 0
                    ]);
                    return;
                }
                echo json_encode([
                    'status' => 1
                ]);
                return;
            } else {
                if (!empty($id)) {
                    $this->data['title'] = 'Edit contact';
                    $this->data['subcontent']['controller'] = 'contact';
                    $contact = $this->model->getContactById($id);
                    if (empty($contact)) {
                        $this->loadError();
                    }
                    $this->data['subcontent']['contact'] = $contact;
                    $this->data['content'] = 'admin/pages/contact/form';
                    $this->render('layouts/admin', $this->data);
                } else {
                    $this->loadError();
                }
            }
        }
        public function delete()
        {
            if (!empty($_POST['id'])) {
                $id = $_POST['id'];
                $res = $this->model->deleteContact($id);
                if (!empty($res)) {
                    echo json_encode([
                        'status' => 1,
                        'contacts' => $this->model->getAllContact()
                    ]);
                    return;
                }
                echo json_encode([
                    'status' => 0
                ]);
                return;
            }
        }
    }

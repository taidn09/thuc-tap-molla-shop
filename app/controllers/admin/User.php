<?php
class User extends Controller
{
    private $data = [];
    private $model = null;
    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function index()
    {
        $this->data['title'] = 'Khách hàng';
        $this->data['subcontent']['controller'] = 'user';
        $this->data['subcontent']['userList'] = $this->model->getUsersList();
        $this->data['content'] = 'admin/pages/user/list';
        $this->render('layouts/admin', $this->data);
    }
    public function detail($id)
    {
        $this->data['title'] = 'Thông tin khách hàng';
        $this->data['subcontent']['controller'] = 'user';
        $user = $this->model->getUserById($id);
        if (!empty($user)) {
            $this->data['subcontent']['user'] = $this->model->getUserById($id);
        } else {
            $this->loadError();
        }
        $this->data['content'] = 'admin/pages/user/detail';
        $this->render('layouts/admin', $this->data);
    }
    public function edit($id = null)
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('user-edit');
            $userId = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $province = $_POST['province-is'];
            $district = $_POST['district-is'];
            $ward = $_POST['ward-is'];
            $street = $_POST['street'];
            if (!empty($_POST['password'])) {
                $password = $_POST['password'];
                $this->model->changePassword($userId,$password);
            }
            $res = $this->model->updateUser($userId, $fname, $lname, $email, $phone, $province, $district, $ward, $street);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                    'user'=> $this->model->getUserById($userId)
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        } else {
            if (!empty($id)) {
                $this->data['title'] = 'Edit user';
                $this->data['subcontent']['controller'] = 'user';
                $user = $this->model->getUserById($id);
                if (empty($user)) {
                    $this->loadError();
                }
                $this->data['subcontent']['user'] = $user;
                $this->data['content'] = 'admin/pages/user/form';
                $this->render('layouts/admin', $this->data);
                echo '<script type="text/javascript">localStorage.setItem("address", JSON.stringify({ province: "' . $user['province'] . '", district: "' . $user['district'] . '", ward: "' . $user['ward'] . '"}))</script>';
            } else {
                $this->loadError();
            }
        }
    }
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('user-delete');
            $id = $_POST['id'];
            $res = $this->model->deleteUser($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'users' => $this->model->getUsersList()
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

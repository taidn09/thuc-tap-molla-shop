<?php
class Admin extends Controller
{
    private $model = null;
    private $data = [];
    public function __construct()
    {
        $this->model = new AdminModel();
    }
    public function index()
    {
        $this->data['title'] = 'Nhân viên';
        $this->data['subcontent']['controller'] = 'admin';
        $this->data['subcontent']['admins'] = $this->model->getAdminList();
        $this->data['content'] = 'admin/pages/qtv/list';
        $this->render('layouts/admin', $this->data);
    }

    public function add()
    {
        if (!empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $image = $_FILES['image'];
            $check = $this->uploadImage($image, 'admin');
            if ($check) {
                echo json_encode([
                    'status' => 0,
                    'uploadErr' => $check
                ]);
                return;
            }
            $new_img_name = md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME))).'.'.strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
            $res = $this->model->createAdmin($name, $email, $password, $new_img_name, $role);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                ]);
                return;
            } else {
                echo json_encode([
                    'status' => 0,
                    'emailErr' => 'Email đã tồn tại...'
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        } else {
            $this->data['title'] = 'Thêm nhân viên';
            $this->data['subcontent']['controller'] = 'admin';
            $this->data['subcontent']['editMode'] = false;
            $this->data['content'] = 'admin/pages/qtv/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function edit($id = null)
    {
        if (!empty($_POST)) {
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            $adminId = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            if (!empty($_FILES['image'])) {
                $image = $_FILES['image'];
                $check = $this->uploadImage($image, 'admin');
                if ($check) {
                    echo json_encode([
                        'status' => 0,
                        'uploadErr' => $check
                    ]);
                    return;
                }
                $new_img_name = md5(strtolower(pathinfo(basename($image['name']), PATHINFO_FILENAME))).'.'.strtolower(pathinfo(basename($image['name']), PATHINFO_EXTENSION));
                $res = $this->model->updateAdmin($adminId, $name, $email, $password, $new_img_name, $role);
            } else {
                $res = $this->model->updateAdmin($adminId, $name, $email, $password, null, $role);
            }
            if ($res !== false) {
                echo json_encode([
                    'status' => 1
                ]);
                return;
            } else {
                echo json_encode([
                    'status' => 0,
                    'emailErr' => 'Email đã tồn tại'
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        } else {
            if (!empty($id)) {
                $this->data['title'] = 'Chỉnh sửa nhân viên';
                $this->data['subcontent']['controller'] = 'admin';
                $this->data['subcontent']['editMode'] = true;
                $admin = $this->model->getAdminById($id);
                if (!empty($admin)) {
                    $this->data['subcontent']['admin'] = $admin;
                } else {
                    $this->loadError();
                }
                $this->data['content'] = 'admin/pages/qtv/form';
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
            $res = $this->model->deleteAdmin($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'admins' => $this->model->getAdminList()
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function authorize($id = null)
    {
        if (!empty($_POST['roles'])) {
            $this->model->deleteRoles($_POST['adminId']);
            foreach ($_POST['roles'] as $role) {
                $result = $this->model->insertAdminRoles($_POST['adminId'], $role);
            }
            if ($result) {
                echo json_encode([
                    'status' => 1
                ]);
                return;
            }
        } else if (!empty($id)) {
            $this->data['title'] = 'Admin authorization';
            $this->data['subcontent']['controller'] = 'admin';
            $admin = $this->model->getAdminById($id);
            if(!empty($admin)){
                $this->data['subcontent']['admin'] = $admin;
            }else{
                $this->loadError();
            }
            $this->data['content'] = 'admin/pages/qtv/authorize';
            $this->render('layouts/admin', $this->data);
        }else{
            $this->loadError();
        }
    }
}

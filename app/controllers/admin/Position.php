<?php
class Position extends Controller
{
    private $model = null;
    private $data = [];
    public function __construct()
    {
        $this->model = new PositionModel();
    }
    public function index()
    {
        $this->data['title'] = 'Chức vụ';
        $this->data['subcontent']['controller'] = 'position';
        $this->data['subcontent']['positions'] = $this->model->getAll(false);
        $this->data['content'] = 'admin/pages/position/list';
        $this->render('layouts/admin', $this->data);
    }

    public function add()
    {
        if (!empty($_POST)) {
            $title = $_POST['title'];
            $check = $this->model->check_existed($title);
            if (!empty($check)) {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Chức vụ đã tồn tại'
                ]);
                return;
            }
            $this->model->add($title);
            echo json_encode([
                'status' => 1,
            ]);
            return;
        } else {
            $this->data['title'] = 'Thêm chức vụ';
            $this->data['subcontent']['controller'] = 'position';
            $this->data['subcontent']['editMode'] = false;
            $this->data['content'] = 'admin/pages/position/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function edit($id = null)
    {
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $check = $this->model->check_existed($title);
            if (!empty($check)) {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Chức vụ đã tồn tại'
                ]);
                return;
            }
            $this->model->update($id, $title);
            echo json_encode([
                'status' => 1,
            ]);
            return;
        } else {
            if (!empty($id)) {
                $this->data['title'] = 'Chỉnh sửa chức vụ';
                $this->data['subcontent']['controller'] = 'postion';
                $this->data['subcontent']['editMode'] = true;
                $position = $this->model->getById($id);
                if (!empty($position)) {
                    $this->data['subcontent']['position'] = $position;
                } else {
                    $this->loadError();
                }
                $this->data['content'] = 'admin/pages/position/form';
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
            $res = $this->model->delete($id);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function authorize()
    {
        if (!empty($_POST['roles'])) {
            $rolesString = implode(',', $_POST['roles']);
            $id = $_POST['id'];
            $result = $this->model->authorize($id, $rolesString);
            if ($result !== false) {
                echo json_encode([
                    'status' => 1
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
        $this->data['subcontent']['title'] = 'Phân quyền';
        $this->data['subcontent']['controller'] = 'position';
        $this->data['subcontent']['positions'] = $this->model->getAll(false);
        $this->data['content'] = 'admin/pages/position/authorize';
        $this->render('layouts/admin', $this->data);
    }
    public function getRoles()
    {
        if(!empty($_POST['id'])){
            $role = $this->model->getRoles($_POST['id']);
            if(!empty($role)){
                $roleArr = array_values(explode(',',$role['rolesString']));
            }else{
                $roleArr = [];
            }
            echo json_encode([
                'status' => 1,
                'roleArr' => $roleArr
            ]);
            return;
        }
    }
}

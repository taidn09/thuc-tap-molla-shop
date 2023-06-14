<?php
class Category extends Controller
{
    private $data = [];
    private $model = null;
    public function __construct()
    {
        $this->model = new CategoryModel();
    }
    public function index()
    {
        $this->data['title'] = 'Danh mục sản phẩm';
        $this->data['subcontent']['controller'] = 'category';
        $this->data['subcontent']['categoryList'] = $this->model->getCategoriesList(false);
        $this->data['content'] = 'admin/pages/category/list';
        $this->render('layouts/admin', $this->data);
    }
    public function add()
    {
        if (!empty($_POST['title'])) {
            $this->checkRolePost('category-add');
            $res = $this->model->addCategory($_POST['title']);
            if (!empty($res)) {
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
            $this->data['title'] = 'Thêm danh mục';
            $this->data['subcontent']['controller'] = 'category';
            $this->data['subcontent']['editMode'] = false;
            $this->data['content'] = 'admin/pages/category/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function edit($id = null)
    {
        if (!empty($_POST['title']) && !empty($_POST['id'])) {
            $this->checkRolePost('category-edit');
            $res = $this->model->updateCategory($_POST['id'], $_POST['title']);
            if (!empty($res)) {
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
            if (!empty($id)) {
                $this->data['title'] = 'Sửa danh mục';
                $this->data['subcontent']['controller'] = 'category';
                $this->data['subcontent']['editMode'] = true;
                $category = $this->model->getCategoryById($id);
                if (empty($category)) {
                    $this->loadError();
                }
                $this->data['subcontent']['category'] = $category;
                $this->data['content'] = 'admin/pages/category/form';
                $this->render('layouts/admin', $this->data);
            } else {
                $this->loadError();
            }
        }
    }
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('category-delete');
            $id = $_POST['id'];
            $res = $this->model->deleteCategory($id);
            if (!empty($res)) {
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
    }
}

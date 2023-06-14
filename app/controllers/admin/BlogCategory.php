<?php
class BlogCategory extends Controller
{
    private $model = null;
    private $data = [];
    public function __construct()
    {
        $this->model = new BlogCategoryModel();
    }
    public function index()
    {
        $this->data['title'] = 'Danh mục tin tức';
        $this->data['subcontent']['controller'] = 'blog-category';
        $this->data['subcontent']['categories'] = $this->model->listAll(true);
        $this->data['content'] = 'admin/pages/blog-category/list';
        $this->render('layouts/admin', $this->data);
    }
    public function add()
    {
        if (!empty($_POST['title'])) {
            $this->checkRolePost('blogCategory-add');
            $res = $this->model->add($_POST['title']);
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
            $this->data['title'] = 'Thêm danh mục tin tức';
            $this->data['subcontent']['editMode'] = false;
            $this->data['subcontent']['controller'] = 'blog-category';
            $this->data['content'] = 'admin/pages/blog-category/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function edit($id = null)
    {

        if (!empty($_POST['title']) && !empty($_POST['id'])) {
            $this->checkRolePost('blogCategory-edit');
            $res = $this->model->edit($_POST['id'], $_POST['title']);
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
            $this->data['title'] = 'Sửa danh mục tin tức';
            $this->data['subcontent']['controller'] = 'blog-category';
            $this->data['subcontent']['editMode'] = true;
            if (!empty($id)) {
                $blogCategory = $this->model->getById($id);
                if (!empty($blogCategory)) {
                    $this->data['subcontent']['category'] = $blogCategory;
                } else {
                    $this->loadError();
                }
            } else {
                $this->loadError();
            }
            $this->data['subcontent']['categories'] = $this->model->listAll();
            $this->data['content'] = 'admin/pages/blog-category/form';
            $this->render('layouts/admin', $this->data);
        }
    }
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('blogCategory-delete');
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
}

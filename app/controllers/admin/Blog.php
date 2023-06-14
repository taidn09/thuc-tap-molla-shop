<?php
class Blog extends Controller
{
    private $model = null;
    private $data = [];
    public function __construct()
    {
        $this->model = new BlogModel();
    }
    public function index()
    {
        $this->data['title'] = 'Blog';
        $this->data['subcontent']['controller'] = 'blog';
        $this->data['subcontent']['blogs'] = $this->model->getAllBlogs(null, true);
        $blogCateModel = new BlogCategoryModel();
        $this->data['subcontent']['categories'] = $blogCateModel->listAll();
        $this->data['content'] = 'admin/pages/blog/list';
        $this->render('layouts/admin', $this->data);
    }
    public function detail($id)
    {
        $this->data['title'] = 'Blog detail';
        $this->data['subcontent']['controller'] = 'blog';
        $blog = $this->model->getBlogById($id, true);
        if (!empty($blog)) {
            $this->data['subcontent']['blog'] = $blog;
        } else {
            $this->loadError();
        }
        $this->data['content'] = 'admin/pages/blog/detail';
        $this->render('layouts/admin', $this->data);
    }
    public function add()
    {
        
        if (!empty($_POST)) {
            $this->checkRolePost('blog-add');
            $title = $_POST['title'];
            $authorId = $_POST['author'];
            $content = $_POST['content'];
            $thumbnail = $_FILES['thumbnail'];
            $shortDesc = $_POST['shortDesc'];
            $blogCateId = $_POST['blogCateId'];
            $time = time();
            $check = $this->uploadImage($thumbnail, 'blog', $time);
            if ($check) {
                echo json_encode([
                    'status' => 0,
                    'uploadErr' => $check
                ]);
                return;
            }

            $new_img_name = md5(strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_FILENAME)) . $time) . '.' . strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_EXTENSION));
            $res = $this->model->addBlog($title, $authorId, $content, $new_img_name, $shortDesc, $blogCateId);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1
                ]);
                return;
            }
        } else {
            $this->data['title'] = 'Add blog';
            $this->data['subcontent']['controller'] = 'blog';
            $this->data['subcontent']['editMode'] = false;
            $blogCateModel = new BlogCategoryModel();
            $this->data['subcontent']['categories'] = $blogCateModel->listAll();
            $this->data['content'] = 'admin/pages/blog/form';
            $this->render('layouts/admin', $this->data);
        }
    }

    public function edit($id = null)
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('blog-edit');
            $blogId = $_POST['id'];
            $title = $_POST['title'];
            $createdAt = $_POST['createdAt'];
            $authorId = $_POST['author'];
            $content = $_POST['content'];
            $shortDesc = $_POST['shortDesc'];
            $blogCateId = $_POST['blogCateId'];
            if (!empty($_FILES['thumbnail'])) {
                $thumbnail = $_FILES['thumbnail'];
                $time = time();
                $check = $this->uploadImage($thumbnail, 'blog', $time);
                if ($check) {
                    echo json_encode([
                        'status' => 0,
                        'uploadErr' => $check
                    ]);
                    return;
                }
                $new_img_name = md5(strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_FILENAME)) . $time) . '.' . strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_EXTENSION));
                $res = $this->model->updateBlog($blogId, $title, $createdAt, $authorId, $content, $new_img_name, $shortDesc, $blogCateId);
            } else {
                $thumbnail = null;
                $res = $this->model->updateBlog($blogId, $title, $createdAt, $authorId, $content, $thumbnail, $shortDesc, $blogCateId);
            }
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        } else {
            if (!empty($id)) {
                $this->data['title'] = 'Edit blog';
                $this->data['subcontent']['controller'] = 'blog';
                $this->data['subcontent']['editMode'] = true;
                $blog = $this->model->getBlogById($id);
                if (empty($blog)) {
                    $this->loadError();
                }
                $this->data['subcontent']['blog'] = $blog;
                $blogCateModel = new BlogCategoryModel();
                $this->data['subcontent']['categories'] = $blogCateModel->listAll(); 
                $this->data['content'] = 'admin/pages/blog/form';
                $this->render('layouts/admin', $this->data);
            } else {
                $this->loadError();
            }
        }
    }
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('blog-delete');
            $id = $_POST['id'];
            $res = $this->model->deleteBlog($id);
            if (!empty($res)) {
                $adminModel = new AdminModel();
                $blogs = $this->model->getAllBlogs();
                foreach ($blogs as $key => $value) {
                    $admin = $adminModel->getAdminById($value['authorId']);
                    $blogs[$key]['author'] = $admin['name'];
                }
                echo json_encode([
                    'status' => 1,
                    'blogs' => $blogs
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function toggle()
    {
        if (!empty($_POST['id'])) {
            $this->checkRolePost('blog-toggle');
            $blogId = $_POST['id'];
            $show = $_POST['show'];
            $res = $this->model->showHideBlog($blogId, $show);
            if ($res !== false) {
                echo json_encode([
                    'status' => 1,
                    'blogs' => $this->model->getAllBlogs(null, true)
                ]);
                return;
            }
            echo json_encode([
                'status' => 0
            ]);
            return;
        }
    }
    public function filter()
    {
        if (!empty($_POST)) {
            $blogs = $this->model->filterAdmin($_POST);
            $adminModel = new AdminModel();
            foreach ($blogs as $key=> $blog) {
                $admin = $adminModel->getAdminById($blog['authorId']);
                $blogs[$key]['author'] = $admin['name'];
            }
            echo json_encode([
                'status' => 1,
                'blogs' => array_values($blogs),
                'allowToggle' => $this->checkRole('blog-toggle'),
                'allowDelete' => $this->checkRole('blog-delete'),
                'allowEdit' => $this->checkRole('blog-edit'),
                'allowViewDetail' => $this->checkRole('blog-detail'),
            ]);
            return;
        }
    }
}

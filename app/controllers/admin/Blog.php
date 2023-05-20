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
        $this->data['subcontent']['blogs'] = $this->model->getAllBlogs(null,true);
        $this->data['content'] = 'admin/pages/blog/list';
        $this->render('layouts/admin', $this->data);
    }
    public function detail($id)
    {
        $this->data['title'] = 'Blog detail';
        $this->data['subcontent']['controller'] = 'blog';
        $blog = $this->model->getBlogById($id,true);
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
            $title = $_POST['title'];
            $authorId = $_POST['author'];
            $content = $_POST['content'];
            $thumbnail = $_FILES['thumbnail'];
            $shortDesc = $_POST['shortDesc'];
            $check = $this->uploadImage($thumbnail, 'blog');
            if ($check) {
                echo json_encode([
                    'status' => 0,
                    'uploadErr' => $check
                ]);
                return;
            }
            
            $new_img_name = md5(strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_FILENAME))).'.'.strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_EXTENSION));
            $res = $this->model->addBlog($title, $authorId, $content, $new_img_name, $shortDesc);
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
            $this->data['content'] = 'admin/pages/blog/form';
            $this->render('layouts/admin', $this->data);
        }
    }

    public function edit($id = null)
    {
        if (!empty($_POST['id'])) {
            $blogId = $_POST['id'];
            $title = $_POST['title'];
            $createdAt = $_POST['createdAt'];
            $authorId = $_POST['author'];
            $content = $_POST['content'];
            $shortDesc = $_POST['shortDesc'];
            if (!empty($_FILES['thumbnail'])) {
                $thumbnail = $_FILES['thumbnail'];
                $check = $this->uploadImage($thumbnail, 'blog');
                if ($check) {
                    echo json_encode([
                        'status' => 0,
                        'uploadErr' => $check
                    ]);
                    return;
                }
                $new_img_name = md5(strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_FILENAME))).'.'.strtolower(pathinfo(basename($thumbnail['name']), PATHINFO_EXTENSION));
                $res = $this->model->updateBlog($blogId, $title, $createdAt, $authorId, $content, $new_img_name, $shortDesc);
            } else {
                $thumbnail = null;
                $res = $this->model->updateBlog($blogId, $title, $createdAt, $authorId, $content, $thumbnail, $shortDesc);
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
            $id = $_POST['id'];
            $res = $this->model->deleteBlog($id);
            if (!empty($res)) {
                $userModel = new UserModel();
                $blogs = $this->model->getAllBlogs();
                foreach ($blogs as $key => $value) {
                    $user = $userModel->getUserById($value['authorId']);
                    $blogs[$key]['author'] = $user['fname'] . ' ' . $user['lname'];
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
            $blogId = $_POST['id'];
            $show = $_POST['show'];
            $res = $this->model->showHideBlog($blogId,$show);
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
}

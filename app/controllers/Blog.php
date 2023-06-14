<?php 

    class Blog extends Controller{
        private $data = [];
        private $model = null;
        public function __construct() {
            $this->model = new BlogModel();
        }
        public function index()
        {
            $perPage = 4;
            $currentPage = 1;
            $start = ($currentPage - 1) * $perPage;
            $blogs = $this->model->getAllBlogs();
            $this->data['subcontent']['totalPage'] = ceil(count($blogs) / $perPage);
            $this->data['subcontent']['totalBlogsFound'] = count($blogs);
            $this->data['subcontent']['currentPage'] = $currentPage;
            $this->data['subcontent']['controller'] = 'blog';
            $this->data['subcontent']['title'] = 'Tin tức';
            $blogCateModel = new BlogCategoryModel();
            $this->data['subcontent']['categories'] = $blogCateModel->listAll();
            $this->data['content'] = 'client/pages/blog';
            $this->data['subcontent']['blogList'] = array_slice($blogs,$start,$perPage);
            $this->data['subcontent']['blogListFull'] =$this->model->getAllBlogs(4);
            $this->render('layouts/client', $this->data);
        }
        public function detail($id){
            $this->data['subcontent']['controller'] = 'blog';
            $this->data['subcontent']['title'] = 'Tin tức chi tiết';
            $this->data['content'] = 'client/pages/single';
            $blogCateModel = new BlogCategoryModel();
            $this->data['subcontent']['categories'] = $blogCateModel->listAll();
            $this->data['subcontent']['nextId'] =  !empty($this->model->getNextBlogId($id)) ?  $this->model->getNextBlogId($id)['blogId'] : "";
            $this->data['subcontent']['prevId'] = !empty($this->model->getPrevBlogId($id)) ?  $this->model->getPrevBlogId($id)['blogId'] : "";
            $blog = $this->model->getBlogById($id);
            if(!empty($blog)){
                $this->data['subcontent']['blog'] = $blog;
            }else{
                $this->loadError();
            }
            $this->data['subcontent']['blogs'] = $this->model->getAllBlogs(4);
            $this->render('layouts/client', $this->data);
        }
        public function paginate()
        {
            if (!empty($_POST)) {
                $currentPage = 1;
                if (!empty($_POST['page']) && is_numeric($_POST['page'])) {
                    $currentPage  = $_POST['page'];
                }
                $perPage = 4;
                $start = ($currentPage - 1) * $perPage;
                $blogs = $this->model->filterClient($_POST);
                $adminModel = new AdminModel();
                foreach ($blogs as $key => $blog) {
                    $blogs[$key]['author'] = $adminModel->getAdminById($blog['authorId'])['name'];
                }
                $totalPage = ceil(count($blogs) / $perPage);
                $result = [
                    'status' => 1,
                    'totalBlogsFound' => count($blogs),
                    'totalPage' => $totalPage,
                    'currentPage' => $currentPage,
                    'blogs' => array_slice($blogs, $start, $perPage)
                ];
                echo json_encode($result);
            }
        }
    }

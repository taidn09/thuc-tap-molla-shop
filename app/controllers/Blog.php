<?php 

    class Blog extends Controller{
        private $data = [];
        private $model = null;
        public function __construct() {
            $this->model = new BlogModel();
        }
        public function index()
        {
            $this->data['subcontent']['controller'] = 'blog';
            $this->data['subcontent']['title'] = 'Tin tức';
            $this->data['content'] = 'client/pages/blog';
            $this->data['subcontent']['blogList'] = $this->model->getAllBlogsClient();
            $this->render('layouts/client', $this->data);
        }
        public function detail($id){
            $this->data['subcontent']['controller'] = 'blog';
            $this->data['subcontent']['title'] = 'Tin tức chi tiết';
            $this->data['content'] = 'client/pages/single';
            $this->data['subcontent']['nextId'] =  !empty($this->model->getNextBlogId($id)) ?  $this->model->getNextBlogId($id)['blogId'] : "";
            $this->data['subcontent']['prevId'] = !empty($this->model->getPrevBlogId($id)) ?  $this->model->getPrevBlogId($id)['blogId'] : "";
            $blog = $this->model->getBlogById($id);
            if(!empty($blog)){
                $this->data['subcontent']['blog'] = $blog;
            }else{
                $this->loadError();
            }
            $this->render('layouts/client', $this->data);
        }
    }
?>
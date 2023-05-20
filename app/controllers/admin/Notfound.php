<?php 
    class Notfound extends Controller{
        public $data =[];
        public function index()
        {     
            $this->data['title'] = '404';
            $this->data['content'] = 'admin/pages/404';
            $this->data['subcontent'] = null;
            $this->render('layouts/admin', $this->data);
        }
    }
?>
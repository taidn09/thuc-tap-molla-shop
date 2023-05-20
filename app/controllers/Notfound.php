<?php 
    class Notfound extends Controller{
        public $data =[];
        public function index()
        {     
            $this->data['title'] = '404';
            $this->data['content'] = 'client/pages/404';
            $this->data['subcontent'] = null;
            $this->render('layouts/client', $this->data);
        }
    }
?>
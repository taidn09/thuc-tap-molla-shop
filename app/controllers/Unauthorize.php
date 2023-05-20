<?php 
    class Unauthorize extends Controller{
        public $data =[];
        public function index()
        {     
            $this->data['title'] = 'Not authorized';
            $this->data['content'] = '../errors/401';
            $this->data['subcontent'] = null;
            $this->render('layouts/admin', $this->data);
        }
    }

<?php

class Home extends Controller
{   
    public $data= [];
    public function index()
    {   
        $productModel = new ProductModel();
        $brandModel = new BrandModel();
        $serviceModel = new ServiceModel();
        $categoryModel = new CategoryModel();
        $blogModel = new BlogModel();
        $this->data['subcontent']['controller'] = 'home';
        $this->data['subcontent']['trendingProducts'] =  $productModel->getTrendingProducts();
        $this->data['subcontent']['newArrivalProducts'] =  $productModel->getNewArrivalProducts();
        $this->data['subcontent']['categoriesList'] =  $categoryModel->getCategoriesList();
        $this->data['subcontent']['brandsList'] =  $brandModel->getBrandsList();
        $this->data['subcontent']['servicesList'] =  $serviceModel->getServicesList();
        $this->data['subcontent']['blogs'] =  $blogModel->getAllBlogs();
        $this->data['content'] = 'client/pages/home';
        $this->render('layouts/client',$this->data);
    }
}

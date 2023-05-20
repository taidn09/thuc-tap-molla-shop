<?php
class Product extends Controller
{
    public $data = [];
    public $model = null;
    public function __construct()
    {
        $this->model = new ProductModel();
    }
    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $perPage = 2;
        $currentPage = 1;
        $start = ($currentPage - 1) * $perPage;
        $productsList = $this->model->getProductFilter([]);
        $categoryModel = new CategoryModel();
        $colorModel = new ColorModel();
        $this->data['title'] = 'Shop';
        $this->data['subcontent']['controller'] = 'product';
        $this->data['subcontent']['totalPage'] = ceil(count($productsList) / $perPage);
        $this->data['subcontent']['totalProductFound'] = count($productsList);
        $this->data['subcontent']['currentPage'] = $currentPage;
        $this->data['subcontent']['productList'] = array_slice($productsList, $start, $perPage);
        $this->data['subcontent']['categories'] = $categoryModel->getCategoryAndProductQuantity();
        $this->data['subcontent']['allSizes'] = $this->model->getAllSizes();
        $this->data['subcontent']['allColors'] = $colorModel->getAllColors();
        $this->data['content'] = 'client/pages/shop';
        $this->render('layouts/client', $this->data);
    }
    public function detail($id)
    {
        $this->data['title'] = 'Product detail';
        if (!empty($this->model->getProductById($id))) {
            $this->data['subcontent']['product'] =  $this->model->getProductById($id);
        } else {
            $this->loadError();
        }
        $categoryModel = new CategoryModel();
        $reviewModel = new ReviewModel();
        $this->data['subcontent']['controller'] = 'product';
        $this->data['subcontent']['category'] =  $categoryModel->getCategoryById($this->data['subcontent']['product']['categoryId']);
        $this->data['subcontent']['imagesGallery'] =  $this->model->getProductImage($id);
        $this->data['subcontent']['reviews'] =  $reviewModel->getReviewList($id);
        $this->data['subcontent']['colors'] =  $this->model->getProductColorWithSize($id);
        $this->data['subcontent']['nextId'] =  !empty($this->model->getNextProductId($id)) ?  $this->model->getNextProductId($id)['productId'] : "";
        $this->data['subcontent']['prevId'] = !empty($this->model->getPrevProductId($id)) ?  $this->model->getPrevProductId($id)['productId'] : "";
        $this->data['subcontent']['relatedProducts'] = $this->model->getRelatedProducts($this->data['subcontent']['category']['categoryId'], $id);
        $this->data['content'] = 'client/pages/product';
        $this->render('layouts/client', $this->data);
    }
    public function filter()
    {
        if (!empty($_POST)) {
            $currentPage = 1;
            if (!empty($_POST['page'])) {
                $currentPage  = $_POST['page'];
            }
            $perPage = 2;
            $start = ($currentPage - 1) * $perPage;
            $productsList = $this->model->getProductFilter($_POST);
            $totalPage = ceil(count($productsList) / $perPage);
            $result = [
                'totalProductFound' => count($productsList),
                'totalPage' => $totalPage,
                'currentPage' => $currentPage,
                'productsList' => array_slice($productsList, $start, $perPage)
            ];
            echo json_encode($result);
        }
    }
    public function search()
    {
        if (!empty($_POST['searchTerm'])) {
            if (!empty($_POST['totalShow'])) {
                $result = $this->model->getDataBySearchTerms($_POST['table'], htmlspecialchars($_POST['searchTerm']), $_POST['totalShow']);
                if ($_POST['table'] == 'blogs') {
                    $adminModel = new AdminModel();
                    foreach ($result as $key => $blog) {
                        $result[$key]['author'] = $adminModel->getAdminById($blog['authorId']);
                    }
                }
                echo json_encode([
                    'result' => $result,
                    'totalShow' => $_POST['totalShow'],
                    'searchTerm' => $_POST['searchTerm'],
                    'table' => $_POST['table'],
                ]);
            } else {
                $this->data['subcontent']['controller'] = '';
                $this->data['title'] = 'Tìm kiếm';
                $this->data['subcontent']['searchTerm'] = $_POST['searchTerm'];
                $result = $this->model->getDataBySearchTerms($_POST['table'], htmlspecialchars($_POST['searchTerm']), 4);
                $this->data['subcontent']['result'] = $result;
                $this->data['content'] = 'client/pages/search';
                $this->render('layouts/client', $this->data);
            }
        } else {
            echo header("location: /");
        }
    }
    public function addReview()
    {
        if (!empty($_POST)) {
            $stars = $_POST['stars'];
            $productId = $_POST['productId'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $reviewModel = new ReviewModel();
            $res = $reviewModel->add($_SESSION['user']['userId'], $productId, $stars, $title, $content);
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'reviews' => $reviewModel->getReviewList($productId)
                ]);
            }
        }
    }
}

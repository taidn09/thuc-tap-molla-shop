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
        $perPage = 6;
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
    public function detail($id = null)
    {
        $this->data['title'] = 'Chi tiết sản phẩm';
        if (empty($id) || empty($this->model->getProductById($id))) {
            $this->loadError();
        } else {
            $this->data['subcontent']['product'] =  $this->model->getProductById($id);
        }
        if (empty($_SESSION['now'])) {
            $this->model->updateProductView($id);
            $_SESSION['now'] = time();
        } else if (time() - $_SESSION['now'] > 60) {
            $this->model->updateProductView($id);
            $_SESSION['now'] = time();
        }
        $categoryModel = new CategoryModel();
        $reviewModel = new ReviewModel();
        $perPage = 5;
        $currentPage = 1;
        $start = ($currentPage - 1) * $perPage;
        $reviews = $reviewModel->getReviewList($id);
        $totalPage = ceil(count($reviews) / $perPage);
        $this->data['subcontent']['controller'] = 'product';
        $this->data['subcontent']['category'] =  $categoryModel->getCategoryById($this->data['subcontent']['product']['categoryId']);
        $this->data['subcontent']['imagesGallery'] =  $this->model->getProductImage($id);
        $this->data['subcontent']['totalPage'] =  $totalPage;
        $this->data['subcontent']['currentPage'] =  $currentPage;
        $this->data['subcontent']['reviews'] = array_slice($reviews, $start, $perPage);
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
            if (!empty($_POST['page']) && is_numeric($_POST['page'])) {
                $currentPage  = $_POST['page'];
            }
            $perPage = 6;
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
                $result = $this->model->getDataBySearchTerms($_POST['table'], htmlspecialchars($_POST['searchTerm']), 2);
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
            $this->checkUserValid();
            $orderId = $_POST['orderId'];
            $stars = $_POST['stars'];
            $productId = $_POST['productId'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $reviewModel = new ReviewModel();
            $orderModel = new OrderModel();
            foreach ($stars as $id => $item) {
                $reviewModel->add($_SESSION['user']['userId'], $productId[$id], $stars[$id], $title[$id], $content[$id]);
            }
            echo json_encode([
                'status' => 1
            ]);
            $orderModel->rated($orderId);
        }
    }
    public function paginateReviews()
    {
        if (!empty($_POST)) {
            $currentPage = 1;
            if (!empty($_POST['page']) && is_numeric($_POST['page'])) {
                $currentPage  = $_POST['page'];
            }
            $id  = $_POST['id'];
            $product = $this->model->getProductById($id);
            if (empty($product)) {
                echo json_encode([
                    'status' => 0,
                ]);
                return;
            }
            $perPage = 5;
            $start = ($currentPage - 1) * $perPage;
            $reviewModel = new ReviewModel();
            $reviews = $reviewModel->getReviewList($id);
            $totalPage = ceil(count($reviews) / $perPage);
            echo json_encode([
                'status' => 1,
                'productId' => $id,
                'totalReviewFound' => count($reviews),
                'totalPage' => $totalPage,
                'currentPage' => $currentPage,
                'reviews' => array_slice($reviews, $start, $perPage)
            ]);
            return;
        }
    }
}

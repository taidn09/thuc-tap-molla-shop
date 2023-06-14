<?php 
    class Review extends Controller{
        private $model = null;
        private $data = [];
        public function __construct() {
            $this->model = new ReviewModel();
        }
        public function index()
        {
            $this->data['title'] = 'Review';
            $this->data['subcontent']['controller'] = 'review';
            $this->data['subcontent']['reviews'] = $this->model->getReviewList();
            $this->data['content'] = 'admin/pages/review/list';
            $this->render('layouts/admin', $this->data);
        }
        public function edit($id = null)
        {
            if (!empty($_POST)) {
                $this->checkRolePost('review-edit');
                $reviewId = $_POST['id'];
                $star = $_POST['star'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $reviewTime = $_POST['reviewTime'];
                $res = $this->model->updateReivew($reviewId, $star, $title, $content , $reviewTime);
                if ($res !== false) {
                    echo json_encode([
                        'status' => 1
                    ]);
                    return;
                }
                echo json_encode([
                    'status' => 0
                ]);
                return;
            } else {
                if (!empty($id)) {
                    $this->data['title'] = 'Edit review';
                    $this->data['subcontent']['controller'] = 'reivew';
                    $review = $this->model->getReviewById($id);
                    if (empty($review)) {
                        $this->loadError();
                    }
                    $this->data['subcontent']['review'] = $review;
                    $this->data['content'] = 'admin/pages/review/form';
                    $this->render('layouts/admin', $this->data);
                } else {
                    $this->loadError();
                }
            }
        }
        public function delete()
        {
            if (!empty($_POST['id'])) {
                $this->checkRolePost('review-delete');
                $id = $_POST['id'];
                $res = $this->model->deleteReview($id);
                if (!empty($res)) {
                    $userModel = new UserModel();
                    $productModel = new ProductModel();
                    $reviews = $this->model->getReviewList();
                    foreach ($reviews as $key => $review) {
                        $user = $userModel->getUserById($review['userId']);
                        $product = $productModel->getProductById($review['productId']);
                        $reviews[$key]['user']['fname'] = $user['fname'];
                        $reviews[$key]['user']['lname'] = $user['lname'];
                        $reviews[$key]['user']['email'] = $user['email'];
                        $reviews[$key]['product']['title'] = $product['title'];
                    }
                    echo json_encode([
                        'status' => 1,
                        'reviews' => $reviews
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

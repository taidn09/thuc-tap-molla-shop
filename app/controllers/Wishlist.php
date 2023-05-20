<?php
class Wishlist extends Controller
{
    private $data = [];
    private $model = null;
    public function __construct()
    {
        $this->model = new WishlistModel();
    }
    public function index()
    {
        if (!empty($_SESSION['user'])) {
            $this->data['subcontent']['controller'] = 'wishlist';
            $this->data['subcontent']['wishlist'] = $this->model->show($_SESSION['user']['userId']);
            $this->data['title'] = 'Danh sách yêu thích';
            $this->data['content'] = 'client/pages/wishlist';
            $this->render('layouts/client', $this->data);
        } else {
            header('location: /');
        }
    }
    public function add()
    {
        if (!empty($_POST) && !empty($_SESSION['user'])) {
            $userId = $_SESSION['user']['userId'];
            $productId = $_POST['productId'];
            $existed = $this->model->existed($userId, $productId);
            if (!empty($existed)) {
                echo json_encode([
                    'status' => 0,
                    'errMsg' => 'Sản phẩm đã tồn tại trong danh sách yêu thích!'
                ]);
                return;
            } else {
                $res = $this->model->add($userId, $productId);
                if (!empty($res)) {
                    echo json_encode([
                        'status' => 1
                    ]);
                    return;
                }
            }
        }
    }
    public function delete()
    {
        if (!empty($_POST)) {
            $userId = $_SESSION['user']['userId'];
            $res = $this->model->delete($userId, $_POST['productId']);
            $wishlist = $this->model->show($userId);
            foreach ($wishlist as $key => $value) {
                
            }
            if (!empty($res)) {
                echo json_encode([
                    'status' => 1,
                    'total' => $this->model->total($userId)['total'],
                    'wishlist' => $wishlist
                ]);
                return;
            }
        }
        echo json_encode([
            'status' => 0
        ]);
        return;
    }
    public function total()
    {
        if (!empty($_SESSION['user'])) {
            $userId = $_SESSION['user']['userId'];
            $total = $this->model->total($userId)['total'];
            if (!empty($total)) {
                echo json_encode([
                    'status' => 1,
                    'total' => $total
                ]);
                return;
            }
        }
        echo json_encode([
            'status' => 0
        ]);
        return;
    }
}

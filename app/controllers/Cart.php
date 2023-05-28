<?php
class Cart extends Controller
{
    public $data  = [];
    public function index()
    {
        $this->list();
    }
    public function initCart()
    {
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }
    public function list()
    {
        $this->initCart();
        $this->data['title'] = 'Giỏ hàng';
        $this->data['subcontent']['controller'] = 'cart';
        $this->data['subcontent']['cart'] = $_SESSION['cart'];
        $this->data['content'] = 'client/pages/cart';
        $this->render('layouts/client', $this->data);
    }
    public function add()
    {
        if ($this->checkUserLogin()) {
            $this->initCart();
            if (!empty($_POST)) {
                $id = $_POST['id'];
                $quantity = $_POST['quantity'];
                $size = $_POST['size'];
                $color = $_POST['color'];
                $productModel = new ProductModel();
                $check = 0;
                if (!empty($_SESSION['cart']) && count($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $item) {
                        if ($item['id'] == $id && $item['sizeSelected'] == $size && $item['colorSelected'] == $color) {
                            $check = 1;
                            $_SESSION['cart'][$key]['quantity'] += $quantity;
                        }
                    }
                }
                $product = $productModel->getCartProductInfo($id);
                $colorArr = $productModel->getProductColors($id);
                $sizeArr = array();
                foreach ($colorArr as $value) {
                    $sizeArr[$value['color']] = $productModel->getColorSizes($id, $value['color']);
                }
                if ($check == 0) {
                    $hardData = [
                        'id' => $product['productId'],
                        'title' => $product['title'],
                        'currentPrice' => $product['currentPrice'],
                        'image' => $product['image'],
                        'quantity' => $quantity,
                        'colorSelected' => $color,
                        'sizeSelected' => $size,
                        'sizes' => $sizeArr,
                        'colors' => $colorArr,
                    ];
                    $_SESSION['cart'][] = $hardData;
                }
                $result = [
                    'loginStatus' => $this->checkUserLogin(),
                    'cart' => $_SESSION['cart'],
                    'total' => $this->getTotalAmount(),
                    'totalQuantity' => $this->getTotalQuantity()
                ];
                echo json_encode($result);
                return;
            }
        }
        $result = [
            'loginStatus' => $this->checkUserLogin(),
        ];
        echo json_encode($result);
        return;
    }
    public function update()
    {
        if (!empty($_SESSION['cart'])) {
            $sizes = $_POST['sizeSelected'];
            $colors = $_POST['colorSelected'];
            $quantities = $_POST['quantity'];
            foreach ($_SESSION['cart'] as $key => $item) {
                $_SESSION['cart'][$key]['sizeSelected'] =  $sizes[$key];
                $_SESSION['cart'][$key]['colorSelected'] =  $colors[$key];
                $_SESSION['cart'][$key]['quantity'] =  $quantities[$key];
            }
            if(count($_SESSION['cart'])>=2){
                for ($i = 0; $i < count($_SESSION['cart']) - 1; $i++) {
                    for ($j = $i + 1; $j <  count($_SESSION['cart']); $j++) {
                        if ($_SESSION['cart'][$i]['id'] == $_SESSION['cart'][$j]['id'] && $_SESSION['cart'][$i]['sizeSelected'] == $_SESSION['cart'][$j]['sizeSelected'] && $_SESSION['cart'][$i]['colorSelected'] == $_SESSION['cart'][$j]['colorSelected']) {
                            $deleteIndex = $_SESSION['cart'][$i]['quantity'] <= $_SESSION['cart'][$j]['quantity'] ? $i : $j;
    
                            $_SESSION['cart'][$i]['quantity'] = $_SESSION['cart'][$i + $j - $deleteIndex]['quantity'];
                            unset($_SESSION['cart'][$deleteIndex]);
                        }
                    }
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            $result = [
                'status' => 1,
                'cart' => $_SESSION['cart'],
                'total' => $this->getTotalAmount(),
                'totalQuantity' => $this->getTotalQuantity()
            ];
            echo json_encode($result);
            return;
        }
        $result = [
            'status' => 0,
        ];
        echo json_encode($result);
        return;
    }
    public function delete()
    {
        if (!empty($_SESSION['cart'])) {
            if (!empty($_POST)) {
                $id = $_POST['id'];
                $size = $_POST['size'];
                $color = $_POST['color'];
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($id, $size, $color) {
                    if ($item['id'] == $id && $item['sizeSelected'] == $size && $item['colorSelected'] == $color) {
                        return false;
                    }
                    return true;
                });
                $_SESSION['cart'] = array_filter($_SESSION['cart']);
                $result = [
                    'cart' => $_SESSION['cart'],
                    'total' => $this->getTotalAmount(),
                    'totalQuantity' => $this->getTotalQuantity()
                ];
                echo json_encode($result);
            }
        }
    }
    public function clear()
    {
        if (!empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
            if (!empty($_SESSION['cart-total-amount'])) {
                unset($_SESSION['cart-total-amount']);
            }
            if (!empty($_SESSION['cart-total-quantity'])) {
                unset($_SESSION['cart-total-quantity']);
            }
            $result = [
                'cart' => array(),
                'total' => $this->getTotalAmount(),
                'totalQuantity' => $this->getTotalQuantity()
            ];
            echo json_encode($result);
            return;
        }
        echo json_encode('failed');
        return;
    }
    public function getTotalAmount()
    {
        if (!empty($_SESSION['cart'])) {
            $total = array_reduce($_SESSION['cart'], function ($accumulator, $item) {
                return $accumulator + $item['currentPrice'] * $item['quantity'];
            }, 0);
            $_SESSION['cart-total-amount'] = $total;    
            return $total;
        }
        $_SESSION['cart-total-amount'] = 0;
        return 0;
    }
    public function getTotalQuantity()
    {
        if (!empty($_SESSION['cart'])) {
            $total = array_reduce($_SESSION['cart'], function ($accumulator, $item) {
                return $accumulator + $item['quantity'];
            }, 0);
            $_SESSION['cart-total-quantity'] = $total;
            return $total;
        }
        $_SESSION['cart-total-quantity'] = 0;
        return 0;
    }
}

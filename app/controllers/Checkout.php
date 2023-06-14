<?php
class Checkout extends Controller
{
    private $data = [];
    public function index()
    {
        if ($this->checkUserLogin() && !empty($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $this->data['title'] = 'Thanh toán';
            $this->data['subcontent'] = null;
            $this->data['content'] = 'client/pages/checkout';
            $this->render('layouts/client', $this->data);
        } else {
            echo header("location: /auth");
        }
    }
    public function complete()
    {
        if (!empty($_POST)) {
            $this->checkUserValid();
            $userId = $_SESSION['user']['userId'];
            $receiver = trim($_POST['fname'], '') . ' ' . trim($_POST['lname'], '');
            $email = trim($_POST['email'], '');
            $phone = trim($_POST['phone'], '');
            $province = $_POST['province-is'];
            $district = $_POST['district-is'];
            $ward = $_POST['ward-is'];
            $street = trim($_POST['street'], '');
            $notes = trim($_POST['notes'], '');
            $summary = $_SESSION['cart-total-amount'];
            $orderModel = new OrderModel();
            $productModel = new ProductModel();
            $orderId = $orderModel->insertOrder($userId, $receiver, $email, $phone, $province, $district, $ward, $street, $summary, $notes);
            $inserOrderDetailsStatus = 1;
            foreach ($_SESSION['cart'] as $item) {
                $total =  $item['currentPrice'] *  $item['quantity'];
                $optionId = $productModel->getOption($item['id'], $item['sizeSelected'], $item['colorSelected'])['optionId'];
                $inserOrderDetailsStatus = $orderModel->insertOrderDetails($orderId, $item['id'],$optionId, $item['currentPrice'], $item['quantity'], $total);
                if ($inserOrderDetailsStatus === false) {
                    echo json_encode([
                        'status' => 0
                    ]);
                    return;
                }
            }
            if (!empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            if (!empty($_SESSION['cart-total-amount'])) {
                unset($_SESSION['cart-total-amount']);
            }
            if (!empty($_SESSION['cart-total-quantity'])) {
                unset($_SESSION['cart-total-quantity']);
            }
            $sendEmailStatus = $this->sendEmail($email, 'Bạn đã đặt hàng thành công, chúng tôi sẽ giao hàng cho bạn trong thời gian sớm nhất, bạn cũn có thể trở lại website để xem các đơn hàng của bạn. Xin cảm ơn !');
            if ($orderId === false) {
                echo json_encode([
                    'status' => 0
                ]);
                return;
            }
            echo json_encode([
                'status' => 1,
                'cart'=> [],
                'total'=> 0,
                'totalQuantity' => 0
            ]);
            return;
        }
    }
}

<?php 
    class Order extends Controller{
        private $model = null;
        private $data = [];
        public function __construct() {
            $this->model = new OrderModel();
        }
        public function index()
        {
            $this->data['title'] = 'Order';
            $this->data['subcontent']['controller'] = 'order';
            $this->data['subcontent']['orders'] = $this->model->getOrderList();
            $this->data['content'] = 'admin/pages/order/list';
            $this->render('layouts/admin', $this->data);
        }
        public function detail($id)
        {
            $this->data['title'] = 'Order detail';
            $this->data['subcontent']['controller'] = 'order';
            $user = $this->model->getOrderById($id);
            if (!empty($user)) {
                $this->data['subcontent']['order'] = $this->model->getOrderById($id);
                $this->data['subcontent']['orderDetail'] = $this->model->getOrderDetail($id);
            } else {
                $this->loadError();
            }
            $this->data['content'] = 'admin/pages/order/detail';
            $this->render('layouts/admin', $this->data);
        }
        public function edit($id = null)
        {
            if (!empty($_POST['id'])) {
                $this->checkRolePost('order-edit');
                $orderId = $_POST['id'];
                $orderDate = $_POST['orderDate'];
                $receiver = $_POST['receiver'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $province = $_POST['province-is'];
                $district = $_POST['district-is'];
                $ward = $_POST['ward-is'];
                $street = $_POST['street'];
                $notes = $_POST['notes'];
                $code = $_POST['code'];
                $res = $this->model->updateOrder($orderId, $orderDate,$receiver, $email, $phone, $province, $district, $ward, $street, $notes, $code);
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
                    $this->data['title'] = 'Edit order';
                    $this->data['subcontent']['controller'] = 'order';
                    $order = $this->model->getOrderById($id);
                    if (empty($order)) {
                        $this->loadError();
                    }

                    echo '<script type="text/javascript">localStorage.setItem("address", JSON.stringify({ province: "' . $order['province'] . '", district: "' . $order['district'] . '", ward: "' . $order['ward'] . '"}))</script>';
                    $this->data['subcontent']['order'] = $order;
                    $this->data['subcontent']['statusCodes'] = $this->model->getStatusCodes();
                    $this->data['content'] = 'admin/pages/order/form';
                    $this->render('layouts/admin', $this->data);
                } else {
                    $this->loadError();
                }
            }
        }
        public function delete()
        {
            if (!empty($_POST['id'])) {
                $this->checkRolePost('order-delete');
                $id = $_POST['id'];
                $res = $this->model->deleteOrder($id);
                if (!empty($res)) {
                    $orderList = $this->model->getOrderList();
                    echo json_encode([
                        'status' => 1,
                        'orders' => $orderList
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

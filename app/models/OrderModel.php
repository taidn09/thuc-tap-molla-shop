<?php
class OrderModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }

    public function insertOrder($userId, $receiver, $email, $phone, $province, $district, $ward, $street, $summary, $notes)
    {
        $orderDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO orders(userId,orderDate, receiver, email,phone, province, district, ward, street, summary, notes) VALUES($userId,'$orderDate','$receiver','$email','$phone','$province','$district','$ward','$street','$summary','$notes')";
        $this->db->exec($query);
        $select = "SELECT orderId FROM orders WHERE userId = '$userId' ORDER BY orderId DESC LIMIT 1";
        $int = $this->db->getOne($select);
        return $int[0];
    }
    public function insertOrderDetails($orderId, $productId, $optionId, $price, $quantity, $total)
    {
        $query = "INSERT INTO order_details(orderId,productId,optionId,price,quantity,total) VALUES($orderId,$productId,$optionId,$price,$quantity,$total)";
        $this->db->exec($query);
    }
    public function updateOrder($orderId, $orderDate, $receiver, $email, $phone, $province, $district, $ward, $street, $notes, $status)
    {
        if ($status == 3) {
            $order_details = $this->getOrderDetail($orderId);
            foreach ($order_details as $key => $item) {
                $qty = $item['quantity'];
                $pro_id = $item['productId'];
                $opt_id = $item['optionId'];
                $this->db->exec("UPDATE products SET sold = sold + $qty WHERE productId = '$pro_id'");
                $this->db->exec("UPDATE product_options SET quantity = quantity - $qty WHERE optionId = '$opt_id'");
            }
        }
        $query = "UPDATE `orders` SET `orderDate`='$orderDate',`receiver`='$receiver',`email`='$email',`phone`='$phone',`province`='$province',`district`='$district',`ward`='$ward',`street`='$street', `notes` = '$notes',`status` = '$status' WHERE orderId = '$orderId'";
        return $this->db->exec($query);
    }
    public function deleteOrder($orderId)
    {
        $query = "DELETE FROM `orders` WHERE orderId = $orderId";
        $query2 = "DELETE FROM `order_details` WHERE orderId = $orderId";
        $this->db->exec($query2);
        return $this->db->exec($query);
    }
    public function getUserOrder($userId)
    {
        $select = "SELECT * FROM `orders` WHERE userId = $userId ORDER BY orderId DESC";

        return $this->db->getAll($select);
    }
    public function getOrderList()
    {
        $select = "SELECT * FROM `orders` ORDER BY orderId DESC";
        return $this->db->getAll($select);
    }
    public function getOrderById($id)
    {
        $select = "SELECT * FROM `orders` WHERE orderId = '$id'";
        return $this->db->getOne($select);
    }
    public function getOrderDetail($orderId)
    {
        $select = "SELECT * FROM `order_details` WHERE orderId = $orderId";
        return $this->db->getAll($select);
    }
    public function getStatusCodes()
    {
        $select = "SELECT * FROM `order_status`";
        return $this->db->getAll($select);
    }
    public function getStatusById($id)
    {
        $select = "SELECT * FROM `order_status` WHERE id = '$id'";
        return $this->db->getOne($select);
    }
    public function cancel($orderId)
    {
        $query = "UPDATE `orders` SET `status` = 4 WHERE orderId = '$orderId'";
        return $this->db->exec($query);
    }
    public function rated($orderId){
        $query = "UPDATE `orders` SET `rated` = 1 WHERE orderId = '$orderId'";
        return $this->db->exec($query);
    }
    public function updateOrderStatus($orderId, $status)
    {
        $query = "UPDATE `orders` SET `status` = $status WHERE orderId = '$orderId'";
        return $this->db->exec($query);
    }
    public function updateOrderDetailStatus($orderId, $optionId, $returned, $reason, $image)
    {
        $this->updateOrderStatus($orderId, 5);
        $query = "UPDATE `order_details` SET `returned` = $returned, `return_reason` ='$reason', `return_image` = '$image'  WHERE orderId = '$orderId' AND optionId = '$optionId'";
        return $this->db->exec($query);
    }
}

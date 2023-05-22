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
        $select = "SELECT orderId FROM orders WHERE userId = $userId ORDER BY orderId DESC LIMIT 1";
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
        $select = "SELECT * FROM `orders` WHERE orderId = $id";
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
    public function cancel($orderId, $status)
    {
        $query = "UPDATE `orders` SET `status` = '$status' WHERE orderId = '$orderId'";
        return $this->db->exec($query);
    }
}

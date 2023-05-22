<?php
class WishlistModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function show($userId)
    {
        $select = "SELECT * FROM `wishlist` WHERE userId = '$userId'";
        return $this->db->getAll($select);
    }
    public function add($userId, $productId)
    {
        $query = "INSERT INTO `wishlist`(`userId`, `productId`) VALUES ('$userId','$productId')";
        return $this->db->exec($query);
    }
    public function delete($userId, $productId)
    {
        $query = "DELETE FROM `wishlist` WHERE userId = '$userId' AND productId = '$productId'";
        return $this->db->exec($query);
    }
    public function deleteAll($userId)
    {
        $query = "DELETE FROM `wishlist` WHERE userId = '$userId'";
        // echo $query;
        return $this->db->exec($query);
    }
    public function total($userId)
    {
        $select = "SELECT count(*) as total FROM `wishlist` WHERE userId = '$userId'";
        return $this->db->getOne($select);
    }
    public function existed($userId, $productId)
    {
        $select = "SELECT * FROM `wishlist` WHERE userId = '$userId' AND productId = '$productId'";
        return $this->db->getOne($select);
    }
}

<?php
class CategoryModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function getCategoriesList($getUncategoried = true)
    {
        if ($getUncategoried) {
            $select = "SELECT * FROM categories";
        } else {
            $select = "SELECT * FROM categories WHERE categoryId != 1";
        }
        return $this->db->getAll($select);
    }
    public function getCategoryAndProductQuantity()
    {

        $select = "SELECT c.categoryId, c.title, SUM(po.quantity) AS totalQuantity
        FROM categories c
        JOIN products p ON c.categoryId = p.categoryId
        LEFT JOIN product_options po ON p.productId = po.productId
        GROUP BY c.categoryId";
        return $this->db->getAll($select);
    }
    public function getCategoryById($id)
    {
        $select = "SELECT * FROM categories WHERE categoryId = $id";
        return $this->db->getOne($select);
    }
    public function addCategory($title)
    {
        $query = "INSERT INTO categories(title) VALUES('$title')";
        return $this->db->exec($query);
    }
    public function updateCategory($id, $title)
    {
        $query = "UPDATE categories SET title = '$title' WHERE categoryId = $id and categoryId != 1";
        return $this->db->exec($query);
    }
    public function deleteCategory($id)
    {
        $query = "DELETE FROM categories WHERE categoryId = $id and categoryId != 1";
        $query2 = "UPDATE `products` SET `categoryId`= 1 WHERE categoryId = $id";
        $this->db->exec($query2);
        return $this->db->exec($query);
    }
}

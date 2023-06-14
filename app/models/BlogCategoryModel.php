<?php
class BlogCategoryModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function listAll($isAdmin = false){
        $select = "SELECT * FROM `blog_categories`";
        if($isAdmin){
            $select = "SELECT * FROM `blog_categories` WHERE id != 1";
        }
        return $this->db->getAll($select);
    }
    public function getById($id){
        $select = "SELECT * FROM `blog_categories` WHERE id = '$id'";
        return $this->db->getOne($select);
    }
    public function add($title){
        $query = "INSERT INTO `blog_categories`(`title`) VALUES ('$title')";
        return $this->db->exec($query);
    }
    public function edit($id,$title){
        $query = "UPDATE `blog_categories` SET `title`='$title' WHERE id ='$id'";
        return $this->db->exec($query);
    }
    public function delete($id){
        $query = "DELETE FROM `blog_categories` WHERE id ='$id'";
        return $this->db->exec($query);
    }
}

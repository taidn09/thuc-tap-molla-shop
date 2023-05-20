<?php
class BlogModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    private function formatQuery($query, $quantity)
    {
        $query .= $quantity == null ? "" : " LIMIT $quantity";
        return $query;
    }

    public function getAllBlogs($quantity  = null, $isAdmin = false)
    {
        $select = "SELECT * FROM blogs";
        if (!$isAdmin) {
            $select .= ' WHERE isShown = 1';
        }
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getAllBlogsClient($quantity  = null)
    {
        $select = "SELECT * FROM blogs WHERE isShown = 1";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getDataBySearchTerm($searchTerm, $quantity = null)
    {
        $select = "SELECT * FROM blogs WHERE title LIKE '%$searchTerm%'";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getBlogById($id, $isAdmin = false)
    {
        $select = "SELECT * FROM blogs WHERE blogId = $id";
        if (!$isAdmin) {
            $select .= ' AND isShown = 1';
        }
        return $this->db->getOne($select);
    }
    public function addBlog($title, $authorId, $content, $thumbnail, $shortDesc)
    {
        $createAt = date('Y-m-d H:i:s');
        $query = "INSERT INTO `blogs`(`title`,`createdAt`, `authorId`, `content`, `thumbnail`, `shortDesc`) VALUES ('$title','$createAt','$authorId','$content','$thumbnail','$shortDesc')";
        return $this->db->exec($query);
    }
    public function updateBlog($id, $title, $createAt, $authorId, $content, $thumbnail, $shortDesc)
    {
        if ($thumbnail) {
            $link = 'public/assets/images/blog/' . $this->getBlogImage($id)['thumbnail'];
            if (file_exists($link)) {
                unlink($link);
            }
            $query = "UPDATE `blogs` SET `title`='$title',`createdAt`='$createAt',`authorId`='$authorId',`content`='$content',`thumbnail`='$thumbnail', `shortDesc` = '$shortDesc' WHERE blogId = $id";
        } else {
            $query = "UPDATE `blogs` SET `title`='$title',`createdAt`='$createAt',`authorId`='$authorId',`content`='$content', `shortDesc` ='$shortDesc' WHERE blogId = $id";
        }
        return $this->db->exec($query);
    }
    public function deleteBlog($id)
    {
        $link = 'public/assets/images/blog/' . $this->getBlogImage($id)['thumbnail'];
        if (file_exists($link)) {
            unlink($link);
        }
        $query = "DELETE FROM blogs WHERE blogId = $id";
        return $this->db->exec($query);
    }
    public function getBlogImage($id)
    {
        $select = "SELECT thumbnail FROM blogs WHERE blogId = $id";
        return $this->db->getOne($select);
    }
    public function showHideBlog($id, $show)
    {
        $query  = "UPDATE `blogs` SET `isShown`= $show WHERE blogId = $id";
        return $this->db->exec($query);
    }
    public function getPrevBlogId($currentId)
    {
        $select = "SELECT blogId FROM blogs WHERE blogId < $currentId AND isShown != 0 ORDER BY blogId ASC LIMIT 1";
        return $this->db->getOne($select);
    }
    public function getNextBlogId($currentId)
    {
        $select = "SELECT blogId FROM blogs WHERE blogId > $currentId AND isShown != 0 ORDER BY blogId ASC LIMIT 1";
        return $this->db->getOne($select);
    }
}

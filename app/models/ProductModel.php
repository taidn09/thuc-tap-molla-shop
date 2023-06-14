<?php

class ProductModel
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
    public function getProductsList($quantity = null, $isAdmin = false)
    {
        $select = "SELECT p.*, ig.image , po.size, po.color
        FROM products p 
        LEFT JOIN (
           SELECT productId, MIN(imgId) as imgId,image 
           FROM images_gallery 
           GROUP BY productId
        ) ig ON p.productId = ig.productId 
        LEFT JOIN (SELECT productId,color, MIN(size) AS size FROM product_options GROUP BY productId) AS po ON p.productId = po.productId 
        WHERE p.deleted = 0";

        if (!$isAdmin) {
            $select .= ' AND p.isShown = 1';
        }

        $select = $this->formatQuery($select, $quantity);
        $select .= " ORDER BY p.productId DESC";
        return $this->db->getAll($select);
    }
    public function getTrendingProducts($quantity = null)
    {
        $select = "SELECT p.*, ig.image, po.size , po.color
        FROM products p 
        LEFT JOIN (SELECT productId, color, MIN(size) AS size, quantity FROM product_options GROUP BY productId) AS po ON p.productId = po.productId
        LEFT JOIN (
                   SELECT productId, MIN(imgId) as imgId ,image 
                   FROM images_gallery 
                   GROUP BY productId
                ) ig ON p.productId = ig.productId WHERE p.isShown = 1 AND p.deleted = 0 AND po.quantity > 0 ORDER BY p.sold";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getNewArrivalProducts($quantity = null)
    {
        $select = "SELECT p.*, ig.image, po.size , po.color
        FROM products p 
        LEFT JOIN (
                   SELECT productId, MIN(imgId) as imgId ,image 
                   FROM images_gallery 
                   GROUP BY productId
                ) ig ON p.productId = ig.productId
        LEFT JOIN (SELECT productId,color, MIN(size) AS size, quantity FROM product_options GROUP BY productId) AS po ON p.productId = po.productId 
        WHERE p.isShown = 1 AND p.deleted = 0 AND po.quantity > 0 ORDER BY p.productId";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getProductImage($productId, $quantity = null)
    {
        $select = "SELECT * FROM images_gallery WHERE productId = '$productId' ORDER BY imgId";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getProductById($id, $isAdmin = false)
    {
        $select = "SELECT * FROM products WHERE productId = '$id'";
        if (!$isAdmin) {
            $select .= ' AND isShown = 1 AND deleted = 0';
        }
        return $this->db->getOne($select);
    }
    public function updateProductView($id){
        $query = "UPDATE `products` SET `views`= views + 1 WHERE productId = '$id'";
        return $this->db->exec($query);
    }
    public function getProductOptions($id, $getDeleted = true)
    {
        $select = "SELECT * FROM product_options WHERE productId = '$id'";
        if ($getDeleted == false) {
            $select .= " AND deleted = 0 ORDER BY color DESC";
        }
        return $this->db->getAll($select);
    }
    public function getRelatedProducts($categoryId, $productId, $quantity = null)
    {
        $select = "SELECT p.*, ig.image 
        FROM products p 
        LEFT JOIN (
           SELECT productId, MIN(imgId) ,image 
           FROM images_gallery 
           GROUP BY productId
        ) ig ON p.productId = ig.productId WHERE p.categoryId = $categoryId AND p.productId != $productId AND isShown = 1 AND deleted = 0";
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function getPrevProductId($currentId)
    {
        $select = "SELECT productId FROM products WHERE productId < $currentId AND isShown = 1 AND deleted = 0 ORDER BY productId DESC LIMIT 1";
        return $this->db->getOne($select);
    }
    public function getNextProductId($currentId)
    {
        $select = "SELECT productId FROM products WHERE productId > $currentId AND isShown = 1 AND deleted = 0 ORDER BY productId ASC LIMIT 1";
        return $this->db->getOne($select);
    }
    public function getCartProductInfo($id)
    {
        $select = "SELECT p.productId, p.title, p.currentPrice, p.originalPrice , ig.image 
            FROM products p 
            LEFT JOIN (
               SELECT productId, MIN(imgId) ,image 
               FROM images_gallery 
               GROUP BY productId
            ) ig ON p.productId = ig.productId WHERE p.productId = $id AND isShown = 1 AND deleted = 0";
        return $this->db->getOne($select);
    }
    public function getProductColors($id)
    {
        $select = "SELECT distinct(color) from product_options WHERE productId = $id AND quantity > 0";
        return $this->db->getAll($select);
    }
    public function getColorSizes($id, $color)
    {
        $select = "SELECT distinct(size), quantity from product_options WHERE productId = $id AND color = '$color' AND quantity > 0";
        return $this->db->getAll($select);
    }
    public function getProductColorWithSize($id)
    {
        $select = "SELECT productId,color, GROUP_CONCAT(size) as sizes, GROUP_CONCAT(quantity) AS quantities
        FROM product_options WHERE productId = $id AND quantity > 0
        GROUP BY color";
        return $this->db->getAll($select);
    }
    public function getAllSizes()
    {
        $select = "SELECT distinct(size) FROM product_options WHERE quantity > 0";
        return $this->db->getAll($select);
    }
    public function getAllColors()
    {
        $select = "SELECT distinct(color) FROM product_options WHERE quantity > 0";
        return $this->db->getAll($select);
    }
    public function getProductFilterAdmin($filterArr)
    {
        $where = '';
        $sortBy = '';
        
        if (!empty($filterArr)) {
            $where = "WHERE ";
            if (!empty($filterArr['catesFilter']) && !in_array('all', $filterArr['catesFilter'])) {
                $where .= 'categoryId IN (' . implode(',', $filterArr['catesFilter']) . ') ';
            }
        }
        $where = $where == 'WHERE ' ? 'WHERE p.deleted != 1' : $where .= " AND p.deleted != 1";
        $select = "SELECT p.*, ig.image, po.size, po.color FROM products p LEFT JOIN (
            SELECT productId, MIN(imgId) as imgId ,image 
            FROM images_gallery 
            GROUP BY productId
         ) ig ON p.productId = ig.productId
         LEFT JOIN product_options po ON p.productId = po.productId $where
         GROUP BY p.productId ORDER BY p.productId DESC";
         return $this->db->getAll($select);
    }
    public function getProductFilter($filterArr)
    {
            $where = '';
            $sortBy = '';
            
            if (!empty($filterArr)) {
                $where = "WHERE ";
                if (!empty($filterArr['catesFilter']) && !in_array('all', $filterArr['catesFilter'])) {
                    $where .= 'categoryId IN (' . implode(',', $filterArr['catesFilter']) . ') ';
                }
            
                if (!empty($filterArr['priceFrom']) && !empty($filterArr['priceTo'])) {
                    $where .= $where == 'WHERE ' ? 'p.currentPrice BETWEEN ' . ($filterArr['priceFrom'] * 1000) . ' AND ' . ($filterArr['priceTo'] * 1000) : 'AND p.currentPrice BETWEEN ' . ($filterArr['priceFrom'] * 1000) . ' AND ' . ($filterArr['priceTo'] * 1000);
                }
            
                if (!empty($filterArr['sortBy'])) {
                    $sortBy = 'ORDER BY p.' . $filterArr['sortBy'] . ' DESC';
                }
            }
            
            $where = $where == 'WHERE ' ? 'WHERE p.isShown = 1 AND p.deleted != 1' : $where .= " AND p.isShown = 1 AND p.deleted != 1";
            $select = "SELECT p.*, ig.image, po.size, po.color FROM products p INNER JOIN (
                SELECT productId, MIN(imgId) as imgId ,image 
                FROM images_gallery 
                GROUP BY productId
             ) ig ON p.productId = ig.productId
             INNER JOIN product_options po ON p.productId = po.productId AND po.quantity > 0 $where
             GROUP BY p.productId $sortBy";
            return $this->db->getAll($select);
       
    }
    public function getDataBySearchTerms($table, $searchTerm, $quantity)
    {
        if ($table == 'products') {
            $select = "SELECT p.*, ig.image, po.size , po.color
        FROM products p 
        LEFT JOIN (SELECT productId,color, MIN(size) AS size FROM product_options GROUP BY productId) AS po ON p.productId = po.productId 
        LEFT JOIN (SELECT productId, MIN(imgId) ,image FROM images_gallery GROUP BY productId) AS ig ON p.productId = ig.productId WHERE p.title LIKE '%$searchTerm%' AND p.isShown = 1 AND p.deleted !=1 ORDER BY p.productId";
        } else {
            $select = "SELECT * FROM blogs WHERE title LIKE '%$searchTerm%'";
        }
        $select = $this->formatQuery($select, $quantity);
        return $this->db->getAll($select);
    }
    public function deleteImage($id)
    {
        $image = $this->db->getOne("SELECT * FROM images_gallery WHERE imgId = $id");
        unlink('public/assets/images/products/' . $image['image']);
        $query = "DELETE FROM images_gallery WHERE imgId = $id";
        return $this->db->exec($query);
    }
    public function addProductImages($productId, $images)
    {
        for ($i = 0; $i < count($images['name']); $i++) {
            $new_img_name = md5(strtolower(pathinfo(basename($images['name'][$i]), PATHINFO_FILENAME))) . '.' . strtolower(pathinfo(basename($images['name'][$i]), PATHINFO_EXTENSION));
            $query = "INSERT INTO images_gallery(productId, image) VALUES($productId,'$new_img_name')";
            $this->db->exec($query);
        }
        return;
    }
    public function getOption($productId, $size, $color)
    {
        $select = "SELECT * FROM product_options WHERE productId = '$productId' AND color ='$color' AND size = '$size'";
        return $this->db->getOne($select);
    }
    public function getOptionById($id, $getDeleted = true)
    {
        $select = "SELECT * FROM product_options WHERE optionId = '$id'";
        if ($getDeleted == false) {
            $select .= " AND deleted = 0";
        }
        return $this->db->getOne($select);
    }
    public function checkOptionExisted($productId, $color, $size, $optionId = null)
    {
        if ($optionId) {
            $select = "SELECT * FROM product_options WHERE productId = $productId AND color = '$color' AND size = '$size' AND optionId != $optionId";
        } else {
            $select = "SELECT * FROM product_options WHERE productId = $productId AND color = '$color' AND size = '$size'";
        }
        return $this->db->getOne($select);
    }
    public function restoreOption($id, $quantity)
    {
        $query = "UPDATE product_options SET deleted = 0, quantity = $quantity WHERE optionId = '$id'";
        return $this->db->exec($query);
    }
    public function deleteOption($id)
    {
        $query = "UPDATE product_options SET deleted = 1 WHERE optionId = $id";
        return $this->db->exec($query);
    }
    public function addOption($productId, $color, $size, $quantity)
    {
        $query = "INSERT INTO `product_options`(`productId`, `size`, `color`, `quantity`) VALUES ($productId,'$size','$color',$quantity)";
        return $this->db->exec($query);
    }
    public function editOption($optionId, $color, $size, $quantity)
    {
        $query = "UPDATE `product_options` SET `size`='$size',`color`='$color',`quantity`= $quantity WHERE optionId = $optionId";
        return $this->db->exec($query);
    }
    public function checkProductExisted($title, $productId = null)
    {
        $title = $this->db->quote($title);
        if ($productId) {
            $select = "SELECT * FROM `products` WHERE title = $title AND productId != $productId AND deleted != 1";
        } else {
            $select = "SELECT * FROM `products` WHERE title = $title AND deleted != 1";
        }
        return $this->db->getOne($select);
    }
    public function deleteProduct($id)
    {
        $query = "UPDATE products set deleted = 1 WHERE productId = '$id'";
        $query2 = "DELETE FROM product_reviews WHERE productId = '$id'";
        $this->db->exec($query2);
        return $this->db->exec($query);
    }
    public function addProduct($title, $originalPrice, $salePercent, $desc, $categoryId)
    {
        $currentPrice = round($originalPrice - $originalPrice * $salePercent / 100, 2);
        $titleEscaped = $this->db->quote($title);
        $descEscaped = $this->db->quote($desc);
        $query = "INSERT INTO `products`(`title`, `originalPrice`, `currentPrice`, `description`, `salePercent`,`categoryId`) VALUES ($titleEscaped,'$originalPrice','$currentPrice',$descEscaped,'$salePercent','$categoryId')";
        return $this->db->exec($query);
    }
    public function editProduct($productId, $title, $originalPrice, $salePercent, $desc, $categoryId)
    {
        $currentPrice = $originalPrice - $originalPrice * $salePercent / 100;
        $query = "UPDATE `products` SET `title`='$title',`originalPrice`='$originalPrice',`currentPrice`='$currentPrice',`description`='$desc',`salePercent`='$salePercent',`categoryId`='$categoryId' WHERE productId = '$productId'";
        return $this->db->exec($query);
    }
    public function showHideProduct($id, $show)
    {
        $query  = "UPDATE `products` SET `isShown`= $show WHERE productId = $id";
        return $this->db->exec($query);
    }
    public function updateRating($productId, $stars, $totalReview)
    {
        $query = "UPDATE products SET rating = ROUND( $stars / $totalReview , 1) WHERE productId = $productId";
        return $this->db->exec($query);
    }
    public function updateReviewCount($productId, $totalReview)
    {
        $query = "UPDATE products SET reviewCount = $totalReview WHERE productId = $productId";
        return $this->db->exec($query);
    }
}

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
        LEFT JOIN (SELECT productId,color, MIN(size) AS size FROM product_options GROUP BY productId) AS po ON p.productId = po.productId WHERE p.deleted = 0";
        if (!$isAdmin) {
            $select .= ' AND p.isShown = 1';
        }
        $select = $this->formatQuery($select, $quantity);
        // echo $select;
        // die;
        return $this->db->getAll($select);
    }
    public function getTrendingProducts($quantity = null)
    {
        $select = "SELECT p.*, ig.image, po.size , po.color
        FROM products p 
        LEFT JOIN (SELECT productId, color, MIN(size) AS size FROM product_options GROUP BY productId) AS po ON p.productId = po.productId 
        LEFT JOIN (
                   SELECT productId, MIN(imgId) as imgId ,image 
                   FROM images_gallery 
                   GROUP BY productId
                ) ig ON p.productId = ig.productId WHERE p.isShown = 1 AND p.deleted = 0 ORDER BY p.sold";
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
        LEFT JOIN (SELECT productId,color, MIN(size) AS size FROM product_options GROUP BY productId) AS po ON p.productId = po.productId 
        WHERE p.isShown = 1 AND p.deleted = 0 ORDER BY p.productId";
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
    public function getProductOptions($id)
    {
        $select = "SELECT * FROM product_options WHERE productId = '$id'";
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
        $select = "SELECT p.productId, p.title, p.currentPrice, ig.image 
            FROM products p 
            LEFT JOIN (
               SELECT productId, MIN(imgId) ,image 
               FROM images_gallery 
               GROUP BY productId
            ) ig ON p.productId = ig.productId WHERE p.productId = $id AND isShown = 1 AND deleted = 0";
        return $this->db->getOne($select);
    }
    // public function getOptionQuantity($productId, $color, $size)
    // {
    //     $select = "SELECT quantity from product_options WHERE productId = $productId AND color = '$color' AND size = '$size'";
    //     return $this->db->getOne($select);
    // }
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
    public function getProductFilter($filterArr)
    {
        $where = '';
        $sortBy = '';
        if (!empty($filterArr)) {
            $where = "WHERE ";
            if (!empty($filterArr['catesFilter'])) {
                $where .= 'categoryId IN(' . implode(',', $filterArr['catesFilter']) . ') ';
            }
            if (!empty($filterArr['sizesFilter'])) {
                $string = '';
                foreach ($filterArr['sizesFilter'] as $value) {
                    $string .= '"' . $value . '",';
                }
                $string = rtrim($string, ',');
                $where .= $where == 'WHERE ' ? 'po.size IN (' . $string . ') ' : 'AND po.size IN (' . $string . ') ';
            }
            if (!empty($filterArr['colorsFilter'])) {
                $string = '';
                foreach ($filterArr['colorsFilter'] as $value) {
                    $string .= '"' . $value . '",';
                }
                $string = rtrim($string, ',');
                $where .= $where == 'WHERE ' ? 'po.color IN (' . $string . ') ' : 'AND po.color IN (' . $string . ') ';
            }
            if (!empty($filterArr['priceFrom']) && !empty($filterArr['priceTo'])) {
                $where .= $where == 'WHERE ' ? 'p.currentPrice BETWEEN ' . $filterArr['priceFrom'] . ' AND ' . $filterArr['priceTo'] : 'WHERE p.currentPrice BETWEEN ' . $filterArr['priceFrom'] . ' AND ' . $filterArr['priceTo'];
            }
            if (!empty($filterArr['sortBy'])) {
                $sortBy = 'ORDER BY p.' . $filterArr['sortBy'] . ' DESC';
            }
        }
        $where = $where == 'WHERE ' ? 'WHERE p.isShown = 1 AND p.deleted != 1' : $where .= " AND p.isShown = 1 AND p.deleted != 1";
        $select = "SELECT p.*, ig.image, po.size, po.color
        FROM products p 
        LEFT JOIN (
                   SELECT productId, MIN(imgId) as imgId ,image 
                   FROM images_gallery 
                   GROUP BY productId
                ) ig ON p.productId = ig.productId
        INNER JOIN product_options po ON p.productId = po.productId $where GROUP BY p.title $sortBy";
        // echo $select;
        // die;
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
        // echo $select;
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
        $select = "SELECT * FROM product_options WHERE productId = $productId AND color ='$color' AND size = '$size'";
        return $this->db->getOne($select);
    }
    public function getOptionById($id)
    {
        $select = "SELECT * FROM product_options WHERE optionId = $id";
        return $this->db->getOne($select);
    }
    public function checkOptionExisted($productId, $color, $size, $optionId = null)
    {
        if ($optionId) {
            $select = "SELECT * FROM product_options WHERE productId = $productId AND color = '$color' AND size = '$size' AND optionId != $optionId";
        } else {
            $select = "SELECT * FROM product_options WHERE productId = $productId AND color = '$color' AND size = '$size'";
        }
        // echo $select;
        return $this->db->getOne($select);
    }
    public function deleteOption($id)
    {
        $query = "DELETE FROM product_options WHERE optionId = $id";
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
        if ($productId) {
            $select = "SELECT * FROM `products` WHERE title = '$title' AND productId != $productId AND deleted != 1";
        } else {
            $select = "SELECT * FROM `products` WHERE title = '$title' AND deleted != 1";
        }
        return $this->db->getOne($select);
    }
    public function deleteProduct($id)
    {
        $query = "UPDATE products set deleted = 1 WHERE productId = $id";
        // $query1 = "DELETE FROM product_options WHERE productId = $id";
        // $images = $this->getProductImage($id);
        // foreach ($images as $item) {
        //     unlink('public/assets/images/products/' . $item['image']);
        // }
        // $query2 = "DELETE FROM images_gallery WHERE productId = $id";
        // $this->db->exec($query1);
        // $this->db->exec($query2);
        return $this->db->exec($query);
    }
    public function addProduct($title, $originalPrice, $salePercent, $desc, $categoryId)
    {
        $currentPrice = number_format($originalPrice - $originalPrice * $salePercent / 100, 2);
        $query = "INSERT INTO `products`(`title`, `originalPrice`, `currentPrice`, `description`, `salePercent`,`categoryId`) VALUES ('$title','$originalPrice','$currentPrice','$desc','$salePercent','$categoryId')";
        return $this->db->exec($query);
    }
    public function editProduct($productId, $title, $originalPrice, $salePercent, $desc, $categoryId)
    {
        $currentPrice = $originalPrice - $originalPrice * $salePercent / 100;
        $query = "UPDATE `products` SET `title`='$title',`originalPrice`='$originalPrice',`currentPrice`='$currentPrice',`description`='$desc',`salePercent`='$salePercent',`categoryId`='$categoryId' WHERE productId = $productId";
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

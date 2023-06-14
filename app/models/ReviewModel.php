<?php

class ReviewModel
{
    private $db = null;
    private $productModel = null;
    public function __construct()
    {
        $this->db = new Connection();
        $this->productModel = new ProductModel();
    }
    public function getReviewList($productId = null)
    {
        if ($productId) {
            $select = "SELECT `reviewId`, users.`userId`, `productId`, `star`, `title`, `content`, `reviewTime`, `helpful`, `unhelpful`,`fname`, `lname`, `email` FROM product_reviews, users WHERE productId = $productId AND product_reviews.userId = users.userId ORDER BY reviewTime DESC";
            return $this->db->getAll($select);
        }
        $select = "SELECT `reviewId`, users.`userId`, `productId`, `star`, `title`, `content`, `reviewTime`, `helpful`, `unhelpful`,`fname`, `lname`, `email` FROM product_reviews, users WHERE product_reviews.userId = users.userId ORDER BY reviewTime DESC";
        return $this->db->getAll($select);
    }
    public function add($userId, $productId, $star, $title, $content)
    {
        $reviewTime = date('Y-m-d H:i:s');
        $query = "INSERT INTO product_reviews(userId, productId,star, title,content,reviewTime) VALUES($userId, $productId, $star, '$title', '$content','$reviewTime')";
        $result = $this->db->exec($query);
        $totalReview = $this->countProductReview($productId)['totalReview'];
        $totalStar = $this->countProductStar($productId)['totalStar'];
        $this->productModel->updateRating($productId, $totalStar, $totalReview);
        $this->productModel->updateReviewCount($productId, $totalReview);
        return $result;
    }
    public function updateReivew($reviewId, $star, $title, $content, $reviewTime)
    {
        $query = "UPDATE `product_reviews` SET `star`='$star',`title`='$title',`content`='$content',`reviewTime`='$reviewTime' WHERE reviewId = $reviewId";
        $productId = $this->getReviewById($reviewId)['productId'];
        $result = $this->db->exec($query);
        $totalReview = $this->countProductReview($productId)['totalReview'];
        $totalStar = $this->countProductStar($productId)['totalStar'];
        $this->productModel->updateRating($productId, $totalStar, $totalReview);
        $this->productModel->updateReviewCount($productId, $totalReview);
        return $result;
    }
    public function deleteReview($reviewId)
    {
        $query = "DELETE FROM `product_reviews` WHERE reviewId = $reviewId";
        $productId = $this->getReviewById($reviewId)['productId'];
        $result = $this->db->exec($query);
        $totalReview = $this->countProductReview($productId)['totalReview'];
        $totalStar = $this->countProductStar($productId)['totalStar'];
        $this->productModel->updateRating($productId, $totalStar, $totalReview);
        $this->productModel->updateReviewCount($productId, $totalReview);
        return $result;
    }
    public function getReviewById($reviewId)
    {
        $select = "SELECT * FROM `product_reviews` WHERE reviewId = $reviewId";
        return $this->db->getOne($select);
    }
    public function countProductReview($productId)
    {
        $select = "SELECT COUNT(*) as totalReview FROM product_reviews WHERE productId = $productId";
        return $this->db->getOne($select);
    }
    public function countProductStar($productId)
    {
        $select = "SELECT SUM(star) as totalStar FROM product_reviews WHERE productId = $productId";
        return $this->db->getOne($select);
    }
}

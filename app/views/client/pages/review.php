<?php
$productIds = array_unique(array_column($detail, 'productId'));
?>
<main class="main">
    <div class="page-content">
        <div class="container">
            <h3 class="mt-3">Đánh giá sản phẩm:</h3>
            <form  action="/product/addReview" class="review-form" method="POST"  class="row">
                <input type="hidden" value="<?=$orderId?>" name="orderId">
                <?php
                $productModel = new ProductModel();
                $categoryModel = new CategoryModel();
                foreach ($productIds as $key => $id) {
                    $product = $productModel->getProductById($id, true);
                    $images = $productModel->getProductImage($id, 1);
                    $category = $categoryModel->getCategoryById($product['categoryId']);
                ?>
                    <div class="col-12 row">
                        <div class="col-2">
                            <img src="/public/assets/images/products/<?= $images[0]['image'] ?>" alt="" class="w-100" style="border: 1px solid #eee">
                        </div>
                        <div class="py-3">
                            <p>Sản phẩm : <b><?= $product['title'] ?></b> - Danh mục: <?= $category['title'] ?></p>
                            <span>Giá: <?= number_format($product['currentPrice']) ?>đ</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mt-3">
                            <span class="mr-3">Số sao:</span>
                            <span>
                                <i class="bi bi-star-fill star yellow" data-value="1"></i>
                                <i class="bi bi-star-fill star yellow" data-value="2"></i>
                                <i class="bi bi-star-fill star yellow" data-value="3"></i>
                                <i class="bi bi-star-fill star yellow" data-value="4"></i>
                                <i class="bi bi-star-fill star yellow" data-value="5"></i>
                            </span>
                            <input type="hidden" name="stars[<?= $product['productId'] ?>]" class="rating-stars" value="5">
                            <input type="hidden" name="productId[<?= $product['productId'] ?>]" id="productId" value="<?= $product['productId'] ?>">
                            <div class="err-msg stars-err-msg text-left"></div>
                            <div class="form-group">
                                <label for="title">Tiêu đề đánh giá</label>
                                <input type="text" class="form-control title" name="title[<?= $product['productId'] ?>]">
                                <div class="err-msg title-err-msg text-left"></div>
                            </div>
                            <div class="form-group">
                                <label for="content">Nội dung đánh giá</label>
                                <textarea maxlength="500" type="text" class="form-control content" name="content[<?= $product['productId'] ?>]"></textarea>
                                <div class="err-msg content-err-msg text-left"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <button class="btn btn-outline-primary" type="submit">Gửi đánh giá</button>
            </form>
            <div class="text-center">
                <a href="/account" class="btn btn-outline-primary">Trở về</a>
            </div>
        </div>
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
    $('.star').on('click', function() {
        var starValue = $(this).data('value');
        $(this).siblings('.star').removeClass('yellow');
        $(this).prevAll().addBack().addClass('yellow');
        $(this).parents('form').find('input.rating-stars').val(starValue)
    });
    // submit đánh giá
    $('.review-form').on('submit', function(e) {
        e.preventDefault()
        let flag = true
        let stars = $(this).find('.rating-stars').val().trim()
        if (stars == '' || isNaN(stars)) {
            $(this).find('.rating-stars').val(5)
        }
        if (flag) {
            const formData = $(this).serialize()
            $.ajax({
                type: 'POST',
                url: '/product/addReview',
                data: formData,
                success: function(response) {
                    checkUserValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/account'
                    }
                },
            });
        }
    })
</script>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Tranh chủ</a></li>
                <li class="breadcrumb-item"><a href="/product">Cửa hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>

            <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="<?= !empty($prevId) ? '/product/detail/' . $prevId : '' ?>" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Sản phẩm trước</span>
                </a>

                <a class="product-pager-link product-pager-next" href="<?= !empty($nextId) ? '/product/detail/' . $nextId : '' ?>" aria-label="Next" tabindex="-1">
                    <span>Sản phẩm sau</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $imagesGallery[0]['image'] ?>" data-zoom-image="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $imagesGallery[0]['image'] ?>" alt="product image">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    <?php
                                    foreach ($imagesGallery as $key => $imageItem) {
                                    ?>
                                        <a class="product-gallery-item <?= $key == 0 ? 'active' : '' ?>" href="#" data-image="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $imageItem['image'] ?>" data-zoom-image="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $imageItem['image'] ?>">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $imageItem['image'] ?>" alt="product side">
                                        </a>
                                    <?php } ?>
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title"><?= $product['title'] ?></h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: <?= ($product['rating'] / 5) * 100 ?>%"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a href="#" class="ml-1">Số lượt xem: <?= $product['views'] ?></a>
                                <a class="ratings-text review-count" href="#product-review-link" id="review-link">Đánh giá (<?= $product['reviewCount'] ?>)</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price d-block">
                                Giá hiện tại: <?= number_format($product['currentPrice']) ?>đ <span class="thick-line-through" style="margin-left: 20px; font-size: 16px;">Giá cũ: <?= number_format($product['originalPrice']) ?>đ</span>
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>Mô tả: <?= strlen($product['description']) > 300 ? substr($product['description'], 0, 300) . '...' : $product['description'] ?></p>
                            </div><!-- End .product-content -->

                            <div class="details-filter-row details-row-size">
                                <label>Màu:</label>

                                <div class="product-nav product-nav-thumbs">
                                    <?php
                                    foreach ($colors as $key => $color) {
                                    ?>
                                        <span class="circle3 <?= $key == 0 ? 'active' : '' ?>" style="background-color:<?= $color['color'] ?>  ;border: 2px solid #fff;box-shadow: 0 0 3px #000; border-radius: 50%" data-color="<?= $color['color'] ?>" data-product-id="<?= $product['productId'] ?>"></span>
                                    <?php } ?>
                                    <input type="hidden" data-product-id="<?= $product['productId'] ?>" class="colorSelected" name="colorSelected" value="<?= $colors['0']['color'] ?>">
                                </div><!-- End .product-nav -->
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="size">Kích cỡ:</label>
                                <div class="select-custom">

                                    <select name="sizeSelected" data-product-id="<?= $product['productId'] ?>" class="size-select form-control" style="padding-left: 60px;">
                                        <?php
                                        foreach ($colors as $key => $color) {

                                            foreach (explode(',', $color['sizes']) as $sizeKey => $size) {
                                        ?>
                                                <option value="<?= $size ?>" class="<?= $key == 0 ? "" : 'd-none' ?>" data-color="<?= $color['color'] ?>" data-quantity='<?= explode(',', $color['quantities'])[$sizeKey] ?>'><?= $size ?></option>
                                        <?php }
                                        } ?>
                                    </select>

                                </div><!-- End .select-custom -->
                                <a href="#" class="size-guide"><i class="icon-th-list"></i>Bảng chọn size</a>
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Số lượng:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="<?= explode(',', $colors[0]['quantities'])[0] ?>" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                                <p class="left-quantity ml-5">Sản phẩm còn lại: <?= number_format(explode(',', $colors[0]['quantities'])[0]) ?></p>
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <?php if (explode(',', $colors[0]['quantities'])[0] > 0) : ?>
                                    <a href="javascript:void(0)" class="btn-product btn-cart" onclick="addToCartDetail('<?= $product['productId'] ?>')"><span>Thêm vào giỏ hàng</span></a>
                                <?php endif ?>
                                <div class="details-action-wrapper">
                                    <a href="javascript:void(0)" class="btn-product btn-wishlist" title="Wishlist" data-productid="<?= $product['productId'] ?>"><span>Thêm vào danh sách yêu thích</span></a>
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Danh mục:</span>
                                    <a href="#"><?= $category['title'] ?></a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Chia sẻ:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Mô tả sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Thông tin thêm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Giao hàng và trả hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active review-count" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá (<?= $product['reviewCount'] ?>)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Thông tin sản phẩm</h3>
                            <p><?= $product['description'] ?></p>

                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Thông tin thêm</h3>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quae distinctio labore nobis veritatis est velit commodi dolor. Adipisci veniam iure dolores perspiciatis ipsa non dolore cum! Molestias obcaecati rerum quaerat.</p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Vận chuyển và trả hàng</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane show active fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3 class="review-count">Đánh giá (<?= $product['reviewCount'] ?>)</h3>
                            <div class="reviews-wrapper">
                                <?php
                                $target = new DateTime('now');
                                if (count($reviews) > 0) {
                                    foreach ($reviews as $review) {
                                        $origin = date_create($review['reviewTime']);
                                        $reviewDateDiff = date_diff($origin, $target)->format('%a')
                                ?>
                                        <div class="review">
                                            <div class="row no-gutters">
                                                <div class="col-auto" style="width: 220px">
                                                    <h4><a href="#"><?= !empty($review['fname']) ? $review['fname'] . ' ' . $review['lname'] : $review['email'] ?></a></h4>
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: <?= $review['star'] * 100 / 5 ?>%"></div><!-- End .ratings-val -->
                                                        </div><!-- End .ratings -->
                                                    </div><!-- End .rating-container -->
                                                    <span class="review-date"><?= $reviewDateDiff == 0 ? 'Hôm nay' : $reviewDateDiff . ' ngày trước' ?></span>
                                                </div><!-- End .col -->
                                                <div class="col">
                                                    <h4><?= $review['title'] ? $review['title'] : 'Không có tiêu đề' ?></h4>

                                                    <div class="review-content">
                                                        <p><?= $review['content'] ? $review['content']  : 'Không có nội dung'  ?></p>
                                                    </div><!-- End .review-content -->

                                                    <div class="review-action">
                                                        <a href="#"><i class="icon-thumbs-up"></i>Hữu ích (0)</a>
                                                        <a href="#"><i class="icon-thumbs-down"></i>Không hữu ích (0)</a>
                                                    </div><!-- End .review-action -->
                                                </div><!-- End .col-auto -->
                                            </div><!-- End .row -->
                                        </div><!-- End .review -->
                                    <?php }
                                    ?>
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center paginate-shop">
                                    <li class="page-item <?= $currentPage < 4 ? 'disabled' : '' ?>">
                                        <a data-productid="<?= $product['productId'] ?>" class="page-link page-link-prev" href="#1" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Trang đầu
                                        </a>
                                    </li>
                                    <?php
                                    for ($i = 1; $i <= $totalPage; $i++) {
                                        if ($currentPage != $i) {
                                            if ($i >  $currentPage - 3  &&  $i < $currentPage + 3) :
                                    ?>
                                                <li class="page-item" aria-current="page"><a class="page-link" data-productid="<?= $product['productId'] ?>" href="#<?= $i ?>"><?= $i ?></a></li>
                                            <?php
                                            endif;
                                        } else {
                                            ?>
                                            <li class="page-item active" aria-current="page"><a class="page-link" data-productid="<?= $product['productId'] ?>" href="#<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <li class="page-item-total">of <?= $totalPage ?></li>
                                    <li class="page-item <?= $currentPage > $totalPage - 3  ? 'disabled' : '' ?>">
                                        <a class="page-link page-link-next" data-productid="<?= $product['productId'] ?>" href="#<?= $totalPage ?>" aria-label="Next">
                                            Trang cuối <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        <?php } else { ?>
                            <p>Sản phẩm này chưa có lượt đánh giá nào</p>
                        <?php } ?>

                        </div><!-- End .reviews -->

                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">Sản phẩm liên quan</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                <?php
                foreach ($relatedProducts as $product) {

                ?>
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            <span class="product-label label-sale">Giảm giá <?= $product['salePercent'] ?>%</span>
                            <a href="#">
                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" data-productid="<?= $product['productId'] ?>" ><span>Thêm vào danh sách yêu thích</span></a>
                                <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a> -->
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="#"><?= $category['title'] ?></a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="#"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                            <div class="product-price">
                                <?= $product['currentPrice'] ?>đ <span class="thick-line-through" style="margin-left: 8px; font-size: 10px;"><?= number_format($product['originalPrice']) ?>đ</span>
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">( <?= $product['reviewCount'] ?> đánh giá )</span>
                            </div><!-- End .rating-container -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                <?php
                }
                ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
    // chọn màu trang chi tiết 
    $('.circle3').on('click', function() {
        var productId = $(this).data('product-id');
        var color = $(this).data('color');
        $(this).siblings('.circle3').removeClass('active');
        $(this).addClass('active');
        $('input[type="hidden"][data-product-id="' + productId + '"]').val($(this).data('color'));
        $('.size-select option').addClass('d-none')
        $('.size-select option[data-color="' + color + '"]').removeClass('d-none')
        $('.size-select').val($('.size-select option').not('.d-none')[0].value)
        let leftQty = $('.size-select option').not('.d-none').data('quantity'); 
        $('.left-quantity').html(`Sản phẩm còn lại: ${Number(leftQty).toLocaleString()}`)
        $('#qty').attr('max', leftQty)
        if (leftQty == 0) {
            $('.product-details-action').html(`<div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist" data-productid="${productId}"><span>Thêm vào danh sách yêu thích</span></a>
                                </div>`)
        } else {
            $('.product-details-action').html(`
                <a href="javascript:void(0)" class="btn-product btn-cart" onclick="addToCartDetail('${productId}')"><span>Thêm vào giỏ hàng</span></a>
                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist" data-productid="${productId}"><span>Thêm vào danh sách yêu thích</span></a>
                                </div>`)
        }
        console.log($('.size-select option').not('.d-none')[0].dataset.quantity);
    });
    $('.size-select').on('change', function() {
        const quantity = $('.size-select option:selected').data('quantity')
        $('.left-quantity').html(`Sản phẩm còn lại: ${Number(quantity).toLocaleString()}`)
        $('#qty').attr('max', quantity)
    })
    function updateReview(response) {
        const {
            reviews,
            totalReviewFound,
            totalPage,
            currentPage,
            productId
        } = JSON.parse(response)
        let reviewsHTML = ''
        if (reviews) {
            for (const key in reviews) {
                const {fname,lname,email,star,content,title,reviewTime} = reviews[key]
                var time = new Date(reviewTime);
                var currentTime = new Date();
                var timeDifference = currentTime - time;
                var seconds = Math.floor(timeDifference / 1000);
                var minutes = Math.floor(seconds / 60);
                var hours = Math.floor(minutes / 60);
                var days = Math.floor(hours / 24);
                reviewsHTML += `
                    <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto" style="width: 220px">
                                        <h4><a href="#">${fname ? fname + ' ' + lname : email}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: ${star*100/5}%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">${days == 0 ? 'Hôm nay' : `${days} ngày trước`}</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>${title ? title : 'Không có tiêu đề'}</h4>

                                        <div class="review-content">
                                            <p>${content ? content: 'Không có nội dung'}</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Hữu ích (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Không hữu ích (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                    `
            }
        }
        $('.reviews-wrapper').html(reviewsHTML)
        $('.review-count').html(`Đánh giá (${totalReviewFound})`)



        let paginateHTML = `<li class="page-item ${currentPage < 4 ? 'disabled' : ''}">
                                        <a data-productid="${productId}" class="page-link page-link-prev" href="#1" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                            <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Trang đầu
                                        </a>
                                    </li>`
        for (let index = 1; index <= totalPage; index++) {
            let isAcitve = index == currentPage ? 'active' : ''
            if (index > (Number(currentPage) - 3) && index < (Number(currentPage) + 3)) {
                paginateHTML += `<li class="page-item ${isAcitve}" aria-current="page"><a data-productid="${productId}" class="page-link" href="#${index}">${index}</a></li>`
            }
        }
        paginateHTML += `
            <li class="page-item-total">of ${totalPage}</li>
            <li class="page-item ${currentPage > totalPage - 3  ? 'disabled' : ''}">
                                        <a class="page-link page-link-next" data-productid="${productId}" href="#${totalPage}" aria-label="Next">
                                            Trang cuối <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                        </a>
                                    </li>`
        $('.paginate-shop').html(paginateHTML)
    }
    $(document).on('click', '.page-item a', function(e) {
        e.preventDefault()
        if (!$(this).parent().hasClass('active')) {
            $(this).parent().siblings().removeClass('active')
            $(this).parent().addClass('active')
        }
        let page = $('.page-item.active a').attr('href').split('')[1];
        let id = $('.page-item.active a').data('productid');
        $.ajax({
            type: 'POST',
            url: '/product/paginateReviews',
            data: {page,id},
            success: function(response) {
                if (response && JSON.parse(response).status == 1) {
                    updateReview(response)
                }
            },
        });
    })
    // add to cart - product detail page
    function addToCartDetail(id) {
        console.log(id, $('#qty').val(), $('.size-select').val(), $('.colorSelected').val());
        addToCart(Number(id), Number($('#qty').val()), $('.size-select').val(), $('.colorSelected').val())
    }
</script>
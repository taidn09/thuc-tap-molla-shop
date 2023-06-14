<?php
echo '<pre>';
// print_r($productList);
echo '</pre>';
?>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Tìm kiếm</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="text-transform: none;"><?= $searchTerm ?></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <?php if (count($result) > 0) { ?>
                    <div class="row search-product-container">
                        <?php
                        if ($_POST['table'] == 'products') {
                            foreach ($result as $key => $product) {
                        ?>
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-<?php
                                                                                if ($product['salePercent'] > 0) {
                                                                                    echo 'sale';
                                                                                } else {
                                                                                    echo '';
                                                                                } ?>"><?php
                                                                                        if ($product['salePercent'] > 0) {
                                                                                            echo 'Giảm giá ' . $product['salePercent'] . "%";
                                                                                        } else {
                                                                                            echo '';
                                                                                        } ?></span>
                                            <a href="/product/detail/<?= $product['productId'] ?>">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable"><span>Thêm vào danh sách yêu thích</span></a>
                                                <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="javascript:void(0)" onclick="addToCart('<?= $product['productId'] ?>',1,'<?= $product['size'] ?>','<?= $product['color'] ?>')" class="btn-product btn-cart"><span>add to cart</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="/product/detail/<?= $product['productId'] ?>"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                <?= $product['currentPrice'] ?>đ
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: <?= ($product['rating'] / 5) * 100 ?>%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( <?= $product['reviewCount'] ?> đánh giá )</span>
                                            </div><!-- End .rating-container -->

                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                            <?php
                            }
                        } else {
                            $adminModel = new AdminModel();
                            foreach ($result as $key => $blog) {
                                $author = $adminModel->getAdminById($blog['authorId']);
                            ?>
                                <div class="entry-item col-sm-4">
                                    <article class="entry entry-grid blog">
                                        <figure class="entry-media">
                                            <a href="/blog/detail/<?= $blog['blogId'] ?>">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/<?= $blog['thumbnail'] ?>" alt="image desc">
                                            </a>
                                        </figure><!-- End .entry-media -->
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a href="#"><?= $author['name'] ?></a>
                                                </span>
                                                <span class="meta-separator">|</span>
                                                <a href="#"><?= $blog['createdAt'] ?></a>
                                                <span class="meta-separator">|</span>
                                                <a href="#"><?= $blog['commentsCount'] ?> bình luận</a>
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title">
                                                <a href="/blog/detail/<?= $blog['blogId'] ?>"><?= $blog['title'] ?></a>
                                            </h2><!-- End .entry-title -->
                                            <div class="entry-content">
                                                <p><?= $blog['shortDesc'] ?></p>
                                                <a href="/blog/detail/<?= $blog['blogId'] ?>" class="read-more">Xem chi tiết</a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </article><!-- End .entry -->
                                </div><!-- End .entry-item -->
                        <?php }
                        } ?>
                    </div><!-- End .row -->
                    <div class="more-container text-center mt-2">
                        <a href="javascript:void(0)" id="search-show-more" class="btn btn-outline-dark-2 btn-more"><span>Xem thêm</span></a>
                    </div><!-- End .more-container -->
                <?php } else { ?>
                    <h2 class="text-center">Không tìm thấy <?= $_POST['table'] == 'products' ? 'sản phẩm' : 'tin tức' ?> nào liên quan đến từ khóa bạn đã nhập</h2>
                <?php } ?>
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
    // show more - search page
    $('#search-show-more').on('click', function() {
        let total = 0
        if ($('#table').val() == 'products') {
            total = $('.search-product-container .product.product-7').length + 4
        } else {
            total = $('.entry-item.col-sm-6').length + 4
        }
        var formData = $('#search-form').serialize();
        const queryString = formData + '&totalShow=' + total; // Tạo một chuỗi query string mới
        if (total && queryString) {
            $.ajax({
                type: 'POST',
                url: '/product/search',
                data: queryString,
                success: function(response) {
                    if (response) {
                        updateSearchPage(response)
                    }
                },
            });
        }
    })
    // update search page after call api
    function updateSearchPage(response) {
        const {
            result,
            totalShow,
            table
        } = JSON.parse(response)
        let resultHTML = ''
        if (result) {
            if (table == 'products') {
                for (const key in result) {
                    const {
                        categoryId,
                        color,
                        currentPrice,
                        description,
                        image,
                        productId,
                        rating,
                        reviewCount,
                        salePercent,
                        title,
                        size,
                        sold
                    } = result[key]
                    let label = salePercent > 0 ? 'sale' : '';
                    resultHTML += `
                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-${label}">${salePercent > 0 ? 'Giảm giá '+salePercent+'%' : ''}</span>
                                            <a href="/product/detail/${productId}">
                                                <img src="/public/assets/images/products/${image}" alt="Product image" class="product-image">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('${productId}')"><span>Thêm vào danh sách yêu thích</span></a>
                                                <!--   <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="javascript:void(0)" onclick="addToCart('${productId}',1,'${size}','${color}')" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="/product/detail/${productId}">${title}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                ${currentPrice}đ
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width:${(rating/5*100).toFixed(0)}%;"></div><!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">( ${reviewCount} đánh giá )</span>
                                            </div><!-- End .rating-container -->

                                        </div><!-- End .product-body -->
                                    </div><!-- End .product -->
                                </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    `
                }
            } else {
                for (const key in result) {
                    const {
                        blogId,
                        author,
                        createdAt,
                        commentsCount,
                        title,
                        shortDesc,
                        thumbnail
                    } = result[key]
                    resultHTML += `
                        <div class="blog entry-item col-sm-4">
                                    <article class="entry entry-grid blog">
                                        <figure class="entry-media">
                                            <a href="/blog/detail/${blogId}">
                                                <img src="/public/assets/images/blog/${thumbnail}" alt="image desc">
                                            </a>
                                        </figure><!-- End .entry-media -->
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a href="#">${author}</a>
                                                </span>
                                                <span class="meta-separator">|</span>
                                                <a href="#">${createdAt}</a>
                                                <span class="meta-separator">|</span>
                                                <a href="#">${commentsCount} bình luận</a>
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title">
                                                <a href="/blog/detail/${blogId}">${title}</a>
                                            </h2><!-- End .entry-title -->
                                            <div class="entry-content">
                                                <p>${shortDesc}</p>
                                                <a href="/blog/detail/${blogId}" class="read-more">Xem chi tiết</a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </article><!-- End .entry -->
                                </div><!-- End .entry-item -->
                    `
                }
            }
            $('.search-product-container').html(resultHTML)
        }
        if (totalShow > Object.keys(result)) {
            $('#search-show-more').css('display', 'none')
        }
    }
</script>
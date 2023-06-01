<main class="main">
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                        "dots": false,
                        "nav": false, 
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
            <div class="intro-slide" style="background-image: url(<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/slider/slide-1.jpg);">
                <div class="container intro-content text-center">
                    <h3 class="intro-subtitle text-white">Bạn trông có vẻ tốt</h3><!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">Bộ ảnh mới</h1><!-- End .intro-title -->

                    <a href="/product" class="btn btn-outline-white-4">
                        <span>Khám phá ngay</span>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->

            <div class="intro-slide" style="background-image: url(<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/slider/slide-2.jpg);">
                <div class="container intro-content text-center">
                    <h3 class="intro-subtitle text-white">Đừng bỏ lỡ</h3><!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">Ưu đãi bất ngờ</h1><!-- End .intro-title -->

                    <a href="/product" class="btn btn-outline-white-4">
                        <span>Khám phá ngay</span>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->
        </div><!-- End .intro-slider owl-carousel owl-theme -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->

    <div class="pt-2 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/banners/banner-1.jpg" alt="Banner">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="#">Sản phẩm mới</a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#"><strong>Women’s</strong></h3><!-- End .banner-title -->
                            <a href="/product" class="btn btn-outline-white banner-link underline">Mua sắm ngay</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/banners/banner-2.jpg" alt="Banner">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="#">Sản phẩm mới</a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#"><strong>Men’s</strong></a></h3><!-- End .banner-title -->
                            <a href="/product" class="btn btn-outline-white banner-link underline">Mua sắm ngay</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->
            </div><!-- End .row -->
            <hr class="mt-0 mb-0">
        </div><!-- End .container -->
    </div><!-- End .bg-gray -->

    <div class="mb-5"></div><!-- End .mb-5 -->
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title">Sản phẩm thịnh hành</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab" role="tab" aria-controls="trending-all-tab" aria-selected="true">All</a>
                </li>
                <?php
                foreach ($categoriesList as $category) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" id="trending-<?= $category['categoryId'] ?>-link" data-toggle="tab" href="#trending-<?= $category['categoryId'] ?>-tab" role="tab" aria-controls="trending-<?= $category['categoryId'] ?>-tab" aria-selected="false"><?= $category['title'] ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel" aria-labelledby="trending-all-link">
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
                    foreach ($trendingProducts as $product) {
                    ?>
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-top">Bán chạy</span>
                                <a href="/product/detail/<?= $product['productId'] ?>">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('<?= $product['productId'] ?>')"><span>Thêm vào danh sách yêu thích</span></a>
                                    <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="quick view"><span>Xem nhanh</span></a> -->
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="javascript:void(0)" onclick="addToCart('<?= $product['productId'] ?>',1,'<?= $product['size'] ?>','<?= $product['color'] ?>')" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="/product/detail/<?= $product['productId'] ?>"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <?= number_format($product['currentPrice']) ?>đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: <?= ($product['rating'] / 5) * 100 ?>%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( <?= $product['reviewCount'] ?> đánh giá )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    <?php } ?>
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <?php
            foreach ($categoriesList as $category) {
            ?>
                <div class="tab-pane p-0 fade" id="trending-<?= $category['categoryId'] ?>-tab" role="tabpanel" aria-labelledby="trending-<?= $category['categoryId'] ?>-link">
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
                        foreach ($trendingProducts as $product) {
                            if ($product['categoryId'] == $category['categoryId']) :
                        ?>
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        <span class="product-label label-top">Bán chạy</span>
                                        <a href="/product/detail/<?= $product['productId'] ?>">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('<?= $product['productId'] ?>')"><span>Thêm vào danh sách yêu thích</span></a>
                                            <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="quick view"><span>quick view</span></a> -->
                                        </div><!-- End .product-action-vertical -->

                                        <div class="product-action">
                                            <a href="javascript:void(0)" class="btn-product btn-cart" onclick="addToCart('<?= $product['productId'] ?>',1,'<?= $product['size'] ?>','<?= $product['color'] ?>')"><span>Thêm vào giỏ hàng</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="/product/detail/<?= $product['productId'] ?>"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <?= number_format($product['currentPrice']) ?>đ
                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: <?= ($product['rating'] / 5) * 100 ?>%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( <?= $product['reviewCount'] ?> Reviews )</span>
                                        </div><!-- End .rating-container -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                        <?php endif;
                        } ?>
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
            <?php } ?>
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- End .mb-5 -->

    <div class="deal bg-image pt-8 pb-8" style="background-image: url(<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/deal/bg-1.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <div class="deal-content text-center">
                        <h4>Số lượng giới hạn</h4>
                        <h2>Chốt đơn ngay hôm nay</h2>
                        <div class="deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                    </div><!-- End .deal-content -->
                    <div class="row deal-products">
                        <div class="col-6 deal-product text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/deal/product-1.jpg" alt="Product image" class="product-image">
                                </a>

                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="product.html">Quần đùi cotton co giãn</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">Hiện tại 500.000 đ</span>
                                    <span class="old-price">Giá gốc 999.000đ</span>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <a href="/product" class="action">Mua sắm ngay</a>
                        </div>
                        <div class="col-6 deal-product text-center">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/deal/product-2.jpg" alt="Product image" class="product-image">
                                </a>

                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="product.html">Áo len dệt kim tinh xảo</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">Hiện tại 500.000 đ</span>
                                    <span class="old-price">Giá gốc 999.000đ</span>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                            <a href="/product" class="action">Mua sắm ngay</a>
                        </div>
                    </div>
                </div><!-- End .col-lg-5 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .deal -->

    <div class="pt-4 pb-3" style="background-color: #222;">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                foreach ($servicesList as $service) {
                ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-box text-center">
                            <span class="icon-box-icon">
                                <i class="<?= $service['icon'] ?>"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title"><?= $service['title'] ?></h3><!-- End .icon-box-title -->
                                <p><?= $service['content'] ?></p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-3 col-sm-6 -->
                <?php } ?>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-2 pb-2 -->

    <div class="mb-6"></div><!-- End .mb-5 -->

    <div class="container">
        <h2 class="title text-center mb-4">Sản phẩm mới</h2><!-- End .title text-center -->

        <div class="products">
            <div class="row justify-content-center">
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
                    foreach ($newArrivalProducts as $product) {
                    ?>
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-new">Mới</span>
                                <a href="/product/detail/<?= $product['productId'] ?>">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="javascipt:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('<?= $product['productId'] ?>')"><span>Thêm vào danh sách yêu thích</span></a>
                                    <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="quick view"><span>quick view</span></a> -->
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="javascript:void(0)" class="btn-product btn-cart" onclick="addToCart('<?= $product['productId'] ?>',1,'<?= $product['size'] ?>','<?= $product['color'] ?>')"><span>Thêm vào giỏ hàng</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <h3 class="product-title"><a href="/product/detail/<?= $product['productId'] ?>"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <?= number_format($product['currentPrice']) ?>đ
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: <?= ($product['rating'] / 5) * 100 ?>%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( <?= $product['reviewCount'] ?> Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    <?php } ?>
                </div><!-- End .owl-carousel -->
            </div><!-- End .row -->
        </div><!-- End .products -->

        <div class="more-container text-center mt-2">
            <a href="/product" class="btn btn-outline-dark-2 btn-more"><span>Xem thêm</span></a>
        </div><!-- End .more-container -->
    </div><!-- End .container -->

    <div class="pb-3">
        <div class="container brands pt-5 pt-lg-7 ">

            <h2 class="title text-center mb-4">Các thương hiệu đồng hành</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":3
                                },
                                "420": {
                                    "items":4
                                },
                                "600": {
                                    "items":5
                                },
                                "900": {
                                    "items":6
                                },
                                "1024": {
                                    "items":8
                                }
                            }
                        }'>
                <?php
                foreach ($brandsList as $brand) {
                ?>
                    <a href="#" class="brand">
                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/brands/<?= $brand['logo'] ?>" alt="Brand Name">
                    </a>
                <?php } ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->

        <div class="mb-5 mb-lg-7"></div><!-- End .mb-5 -->

        <div class="container newsletter">
            <div class="row">
                <div class="col-lg-6 banner-overlay-div">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/demos/demo-6/banners/banner-3.jpg" alt="Banner">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="#">Thời gian giới hạn</a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#">Cuối mùa<br>giảm sốc 50%</a></h3><!-- End .banner-title -->
                            <a href="/product" class="btn btn-outline-white banner-link underline">Mua sắm ngay</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6 d-flex align-items-stretch subscribe-div">
                    <div class="cta cta-box">
                        <div class="cta-content">
                            <h3 class="cta-title">Đăng ký ngay để nhận thông báo mới</h3><!-- End .cta-title -->
                            <p>Đăng ký ngay bây giờ <span class="primary-color">nhận 10% giảm giá</span>ở lần đặt hàng đầu tiên.</p>

                            <form action="#">
                                <input type="email" class="form-control" placeholder="Nhập email của bạn" aria-label="Email Adress" required>
                                <div class="text-center">
                                    <button class="btn btn-outline-dark-2" type="submit"><span>Đăng ký</span></i></button>
                                </div><!-- End .text-center -->
                            </form>
                        </div><!-- End .cta-content -->
                    </div><!-- End .cta -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-gray -->

    <div class="mb-2"></div><!-- End .mb-5 -->

    <div class="container">
    </div><!-- End .container -->

    <div class="blog-posts mb-5">
        <div class="container">
            <h2 class="title text-center mb-4">Tin tức</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple mb-3" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                <?php
                $adminModel = new AdminModel();
                foreach ($blogs as $blog) {
                    $author = $adminModel->getAdminById($blog['authorId']);
                ?>
                    <article class="entry blog">
                        <figure class="entry-media">
                            <a href="/blog/detail/<?= $blog['blogId'] ?>">
                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/<?= $blog['thumbnail'] ?>" alt="image desc">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body text-center">
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
                <?php
                }
                ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .blog-posts -->
</main><!-- End .main -->
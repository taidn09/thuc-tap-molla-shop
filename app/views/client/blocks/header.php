<header class="header header-6">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <ul class="top-menu top-link-menu d-none d-md-block">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Số điện thoại: +0123 456 789</a></li>
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="social-icons social-icons-color">
                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon social-pinterest" title="Instagram" target="_blank"><i class="icon-pinterest-p"></i></a>
                    <a href="#" class="social-icon social-instagram" title="Pinterest" target="_blank"><i class="icon-instagram"></i></a>
                </div><!-- End .soial-icons -->
                <ul class="top-menu top-link-menu">
                    <li>
                        <a href="#">Links</a>
                        <?php if ($_SERVER['REQUEST_URI'] != '/auth') : ?>
                            <ul>
                                <?php if (!empty($_SESSION['user'])) { ?>
                                    <li><a href="/auth/logout"><i class="icon-user"></i>Đăng xuất</a></li>
                                <?php } else { ?>
                                    <li><a href="/auth"><i class="icon-user"></i>Đăng nhập</a></li>
                                <?php } ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul><!-- End .top-menu -->

            </div><!-- End .header-right -->
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="/product/search" method="POST" id="search-form">

                        <div class="d-flex">
                            <div class="from-group mr-2">
                                <!-- <label for="table">Tìm kiếm</label> -->
                                <select name="table" id="table" class="from-control form-select">
                                    <option value="products" <?php if (!empty($_POST['table']) && $_POST['table'] == 'products') echo 'selected' ?>>Sản phẩm</option>
                                    <option value="blogs" <?php if (!empty($_POST['table']) && $_POST['table'] == 'blogs') echo 'selected' ?>>Tin tức</option>
                                </select>
                            </div>
                            <div class="search-wrapper-wide">
                                <label for="q" class="sr-only">Tìm kiếm</label>
                                <input type="text" class="form-control" name="searchTerm" id="q" placeholder="Nhập từ khóa để tìm kiếm..." value="<?= !empty($searchTerm) ? $searchTerm : '' ?>">
                            </div><!-- End .header-search-wrapper -->
                        </div>
                    </form>
                </div><!-- End .header-search -->
            </div>
            <div class="header-center">
                <a href="/" class="logo">
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/logo.png" alt="Molla Logo" width="82" height="20">
                </a>
            </div><!-- End .header-left -->

            <div class="header-right">
                <a href="/wishlist" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <span class="wishlist-count">0</span>
                    <span class="wishlist-txt">Đã thích</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count"><?= !empty($_SESSION['cart-total-quantity']) ? number_format($_SESSION['cart-total-quantity']) : 0 ?></span>
                        <span class="cart-txt"><?= !empty($_SESSION['cart-total-amount']) ? number_format($_SESSION['cart-total-amount']) : 0 ?>đ</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <?php
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $id => $item) {
                            ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/product/detail/${id}"><?= $item['title'] ?></a>
                                            </h4>
                                            <div class="d-flex align-items-center">
                                                <span class="cart-product-qty circle active" style="background-color: <?= $item['colorSelected'] ?>; width: 15px; height: 15px; margin-left: 4px;"></span>
                                                - <?= $item['sizeSelected'] ?>
                                            </div>
                                            <span class="cart-product-info">
                                                <span class="cart-product-qty"><?= $item['quantity'] ?></span>
                                                x $<?= $item['currentPrice'] ?>
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="/product/detail/${id}" class="product-image">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                                            </a>
                                        </figure>
                                    </div><!-- End .product -->
                            <?php }
                            } ?>
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Tổng cộng</span>

                            <span class="cart-total-price"><?= !empty($_SESSION['cart-total-amount']) ? number_format($_SESSION['cart-total-amount']) : 0 ?>đ</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="/cart" class="btn btn-primary">Xem giỏ hàng</a>
                            <a href="/checkout" class="btn btn-outline-primary-2 color-hv-fff"><span>Thanh toán</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="<?= (!empty($controller) && $controller == 'home') ? 'active' : '' ?>">
                            <a href="/">Trang chủ</a>
                        </li>
                        <li class="<?= (!empty($controller) && $controller == 'product') ? 'active' : '' ?>">
                            <a href="/product">Cửa hàng</a>
                        </li>
                        <li class="<?= (!empty($controller) && $controller == 'contact') ? 'active' : '' ?>"><a href="/contact">Liên hệ</a></li>
                        <li class="<?= (!empty($controller) && $controller == 'blog') ? 'active' : '' ?>"><a href="/blog">Tin tức</a></li>
                        <?php
                        if (!empty($_SESSION['user'])) {
                        ?>
                            <li class="<?= (!empty($controller) && $controller == 'account') ? 'active' : '' ?>"><a href="/account">Tài khoản</a></li>
                        <?php } ?>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->

                <button class="mobile-menu-toggler">
                    <span class="sr-only">Ẩn hiện menu trên di động</span>
                    <i class="icon-bars"></i>
                </button>
            </div><!-- End .header-left -->

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <p>Giải phóng mặt bằng giảm giá tới 30%</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header>
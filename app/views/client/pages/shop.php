<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active"><a href="/product">Cửa hàng</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Đang hiển thị <span><?= count($productList) ?> trong số <?= $totalProductFound ?></span> sản phẩm
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sắp xếp theo:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="" selected="selected">-- Xếp theo --</option>
                                        <option value="sold">Lượt bán</option>
                                        <option value="rating">Đánh giá</option>
                                        <option value="productId">Mới - cũ</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->

                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products-nav-wrapper">
                        <div class="products mb-3">
                            <div class="row justify-content-center products-list-container">
                                <?php
                                foreach ($productList as $key => $product) {
                                ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
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
                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('<?=$product['productId']?>')"><span>Thêm vào danh sách yêu thích</span></a>
                                                    <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
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
                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                                <?php
                                }
                                ?>
                            </div><!-- End .row -->
                        </div><!-- End .products -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center paginate-shop">
                                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link page-link-prev" href="#<?= $currentPage - 1 ?>" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Trang trước
                                    </a>
                                </li>
                                <?php
                                for ($i = 0; $i < $totalPage; $i++) {
                                ?>
                                    <li class="page-item <?= $i + 1 == $currentPage ? 'active' : '' ?>" aria-current="page"><a class="page-link" href="#<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
                                <?php
                                }
                                ?>
                                <li class="page-item-total">of <?= $totalPage ?></li>
                                <li class="page-item <?= $currentPage >= $totalPage ? 'disabled' : '' ?>">
                                    <a class="page-link page-link-next" href="#<?= $currentPage + 1 ?>" aria-label="Next">
                                        Trang sau <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <form id="filter-form" class="sidebar sidebar-shop" action="/product/filter" method="POST">
                        <div class="widget widget-clean">
                            <label>Lọc sản phẩm:</label>
                            <!-- <a href="#" class="sidebar-filter-clear">Xóa tất cả</a> -->
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Danh mục
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        <?php
                                        foreach ($categories as $key => $category) {
                                        ?>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input name="catesFilter[]" type="checkbox" class="custom-control-input" value="<?= $category['categoryId'] ?>" id="cat-<?= $category['categoryId'] ?>">
                                                    <label class="custom-control-label" for="cat-<?= $category['categoryId'] ?>"><?= $category['title'] ?></label>
                                                </div><!-- End .custom-checkbox -->
                                                <span class="item-count"><?= $category['totalQuantity'] ?></span>
                                            </div><!-- End .filter-item -->
                                        <?php }
                                        ?>
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                    Kích thước
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-2">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <?php
                                        foreach ($allSizes as $key => $size) {
                                        ?>
                                            <!-- <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="sizesFilter[]" value="<?= $size['size'] ?>" class="custom-control-input" id="size-<?= $size['size'] ?>">
                                                    <label class="custom-control-label" for="size-<?= $size['size'] ?>"><?= $size['size'] ?></label>
                                                </div>
                                            </div> -->
                                        <?php
                                        }
                                        ?>
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sizesFilter[]" value="S" class="custom-control-input" id="size-S">
                                                <label class="custom-control-label" for="size-S">S</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sizesFilter[]" value="M" class="custom-control-input" id="size-M">
                                                <label class="custom-control-label" for="size-M">M</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sizesFilter[]" value="L" class="custom-control-input" id="size-L">
                                                <label class="custom-control-label" for="size-L">L</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sizesFilter[]" value="XL" class="custom-control-input" id="size-XL">
                                                <label class="custom-control-label" for="size-XL">XL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="sizesFilter[]" value="XXL" class="custom-control-input" id="size-XXL">
                                                <label class="custom-control-label" for="size-XXL">XXL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                    Màu sắc
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-3">
                                <div class="widget-body">
                                    <div class="filter-colors">
                                        <?php
                                        foreach ($allColors as $key => $color) {
                                        ?>
                                            <label style="background: <?= $color['color'] ?>; border: 2px solid" for="color-<?= $color['color'] ?>" class="color-circle-shop <?= $color['color'] ?>"><span class="sr-only">Color Name</span></label>
                                            <input type="checkbox" hidden name="colorsFilter[]" value="<?= $color['color'] ?>" id="color-<?= $color['color'] ?>">
                                        <?php
                                        } ?>
                                    </div><!-- End .filter-colors -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Giá tiền
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Chọn giá:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        <div class="widget">
                            <button type="submit" class="btn btn-outline-primary">Tiến hành lọc</button>
                        </div>
                    </form><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
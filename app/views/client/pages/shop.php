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
                                                    <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" data-productid="<?= $product['productId'] ?>"><span>Thêm vào danh sách yêu thích</span></a>
                                                    <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <a href="javascript:void(0)" onclick="addToCart('<?= $product['productId'] ?>',1,'<?= $product['size'] ?>','<?= $product['color'] ?>')" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->
                                            <div class="product-body">
                                                <h3 class="product-title"><a href="/product/detail/<?= $product['productId'] ?>"><?= $product['title'] ?></a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    <?= number_format($product['currentPrice']) ?>đ <span class="thick-line-through" style="margin-left: 8px; font-size: 10px;"><?= number_format($product['originalPrice']) ?>đ</span>
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
                                                <span class="item-count"><?= number_format($category['totalQuantity']) ?></span>
                                            </div><!-- End .filter-item -->
                                        <?php }
                                        ?>
                                    </div><!-- End .filter-items -->
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
<script>
    $('.color-circle-shop').on('click', function() {
        $(this).toggleClass('selected');
    });
    $("#filter-form").on("submit", function(event) {
        event.preventDefault();
        callFilterProducts(1)
    });

    function updateShopPage(response) {
        const {
            productsList,
            currentPage,
            totalPage,
            totalProductFound
        } = JSON.parse(response)
        let productsHTML = ''
        if (totalProductFound > 0) {
            if (productsList) {
                for (const key in productsList) {
                    const {
                        categoryId,
                        color,
                        currentPrice,
                        originalPrice,
                        description,
                        image,
                        productId,
                        rating,
                        reviewCount,
                        salePercent,
                        title,
                        size,
                        sold
                    } = productsList[key]
                    let label = salePercent > 0 ? 'sale' : '';
                    productsHTML += `
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                                    <div class="product product-7 text-center">
                                        <figure class="product-media">
                                            <span class="product-label label-${label}">${salePercent > 0 ? 'Giảm giá '+salePercent+'%' : ''}</span>
                                            <a href="/product/detail/${productId}">
                                                <img src="/public/assets/images/products/${image}" alt="Product image" class="product-image">
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" data-productid="${productId}"><span>Thêm vào danh sách yêu thích</span></a>
                                                <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="javascript:void(0)" onclick="addToCart('${productId}',1,'${size}','${color}')" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="/product/detail/${productId}">${title}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                ${Number(currentPrice).toLocaleString('en-US', priceFormatOption)}đ <span class="thick-line-through" style="margin-left: 8px; font-size: 10px;">${Number(originalPrice).toLocaleString('en-US', priceFormatOption)}đ</span>
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
            }
            $('.products-list-container').html(productsHTML)
            $('.toolbox-info').html(`Đang hiển thị <span>${Object.keys(productsList).length} trong số ${totalProductFound}</span> sản phẩm`)
        } else {
            $('.toolbox-info').html(`Đang hiển thị <span>${Object.keys(productsList).length} trong số ${totalProductFound}</span> sản phẩm`)
            $('.products-list-container').html('<h3 class="text-center">Hiện chưa có sản phẩm nào</h3>')
        }
        let paginateHTML = ` <li class="page-item ${currentPage == 1 ? 'disabled' : ''}">
                                <a class="page-link page-link-prev" href="#${currentPage - 1}" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Trang trước
                                </a>
                            </li>`
        for (let index = 0; index < totalPage; index++) {
            let isAcitve = index + 1 == currentPage ? 'active' : ''
            paginateHTML += `
                    <li class="page-item ${isAcitve}" aria-current="page"><a class="page-link" href="#${index+1}">${index+1}</a></li>
                `
        }
        paginateHTML += `
            <li class="page-item-total">of ${totalPage}</li>
            <li class="page-item ${currentPage >= totalPage ? 'disabled' : ''}">
                                <a class="page-link page-link-next" href="#${Number(currentPage) + 1}" aria-label="Next">
                                    Trang sau <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>`
        $('.paginate-shop').html(paginateHTML)
        $('.page-item a').on('click', function(e) {
            e.preventDefault()
            if (!$(this).parent().hasClass('active')) {
                $(this).parent().siblings().removeClass('active')
                $(this).parent().addClass('active')
                if (window.location.pathname == '/blog') {
                    paginateBlogs()
                } else {
                    callFilterProducts()
                }
            }
        }) 
    }

    $('.page-item a').on('click', function(e) {
        e.preventDefault()
        if (!$(this).parent().hasClass('active')) {
            $(this).parent().siblings().removeClass('active')
            $(this).parent().addClass('active')
            if (window.location.pathname == '/blog') {
                paginateBlogs()
            } else {
                callFilterProducts()
            }
        }

    })
    $('#sortby').on('change', function() {
        callFilterProducts()
    })

    function callFilterProducts(page = null) {
        var formData = $('#filter-form').serialize();
        const priceFrom = $('.noUi-handle-lower').text().replace('K', '');
        const priceTo = $('.noUi-handle-upper').text().replace('K', '');
        if (page == null) {
            page = $('.page-item.active a').attr('href').split('')[1];
        }
        const sortBy = $('#sortby').val();
        const queryString = formData + '&priceFrom=' + priceFrom + '&priceTo=' + priceTo + '&page=' + page + '&sortBy=' + sortBy; // Tạo một chuỗi query string mới
        $.ajax({
            type: 'POST',
            url: '/product/filter',
            data: queryString, // Truyền chuỗi query string mới vào data
            success: function(response) {
                if (response) {
                    updateShopPage(response)
                }
            },
        });
    }
</script>
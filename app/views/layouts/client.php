<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= !empty($title) ? $title : 'Trang chủ' ?></title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/site.html">
    <link rel="mask-icon" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="<?php echo _WEB_ROOT; ?>/public/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/plugins/jquery.countdown.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/plugins/nouislider/nouislider.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/style.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/skins/skin-demo-6.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/demos/demo-6.css">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/client/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <style>
        .swal2-popup {
            font-size: 1.5rem;
        }

        .circle3.active {
            border: 2px solid !important;
        }

        .blog {
            min-height: 600px;
        }

        .float {
            position: fixed;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            text-decoration: none;
            color: #fff;

        }

        .btn-1 {
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            box-shadow: 0 0 0 3px rgba(0, 211, 102, 0.5), 0 0 0 10px rgba(0, 211, 102, 0.2);
            animation: ani1 infinite 1s linear;
        }

        .btn-2 {
            bottom: 120px;
            right: 40px;
            background-color: rgba(58, 134, 255, 1);
            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.5), 0 0 0 10px rgba(58, 134, 255, 0.5);
            animation: ani2 infinite 1s linear;
        }

        @keyframes ani1 {
            0% {
                box-shadow: 0 0 0 3px rgba(0, 211, 102, 0.5), 0 0 0 10px rgba(0, 211, 102, 0.2);
            }

            100% {
                box-shadow: 0 0 0 10px rgba(0, 211, 102, 0.5), 0 0 0 0px rgba(0, 211, 102, 0.2);
            }
        }

        @keyframes ani2 {
            0% {
                box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.5), 0 0 0 10px rgba(58, 134, 255, 0.5);
            }

            100% {
                box-shadow: 0 0 0 10px rgba(58, 134, 255, 0.5), 0 0 0 0px rgba(58, 134, 255, 0.5);
            }
        }

        .float:hover,
        .float:active .float:visited {
            color: #fff;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <?php
        $this->render('client/blocks/header', $subcontent);
        $this->render($content, $subcontent);
        $this->render('client/blocks/footer');
        if ($_SERVER['REQUEST_URI'] != '/auth') {
            $this->render('client/blocks/login-modal');
        }
        $this->render('client/blocks/mobile-menu');
        $this->render('client/blocks/newsletters-popup');
        ?>
    </div>
    <!-- Plugins JS File -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.hoverIntent.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/superfish.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/owl.carousel.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/wNumb.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/bootstrap-input-spinner.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.elevateZoom.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.plugin.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/jquery.countdown.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/nouislider.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/isotope.pkgd.min.js"></script>
    <!-- Main JS File -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/main.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/demos/demo-6.js"></script>
    <script>
        $(".nav-link[role=tab]").on('click', function() {
            $('.err-msg').html('')
            $('input').val('')
        })
        $(".close[data-dismiss=modal]").on('click', function() {
            $('.err-msg').html('')
        })
        if ($.fn.elevateZoom) {
            $("#product-zoom").elevateZoom({
                gallery: "product-zoom-gallery",
                galleryActiveClass: "active",
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 400,
                zoomWindowFadeOut: 400,
                responsive: true,
            });

            // On click change thumbs active item
            $(".product-gallery-item").on("click", function(e) {
                $("#product-zoom-gallery").find("a").removeClass("active");
                $(this).addClass("active");

                e.preventDefault();
            });

            var ez = $("#product-zoom").data("elevateZoom");

            // Open popup - product images
            $("#btn-product-gallery").on("click", function(e) {
                if ($.fn.magnificPopup) {
                    $.magnificPopup.open({
                            items: ez.getGalleryList(),
                            type: "image",
                            gallery: {
                                enabled: true,
                            },
                            fixedContentPos: false,
                            removalDelay: 600,
                            closeBtnInside: false,
                        },
                        0
                    );

                    e.preventDefault();
                }
            });
        }
        $("input").on('input', function() {
            $(this).siblings('.err-msg').html('')
        })
        $("textarea").on('input', function() {
            $(this).siblings('.err-msg').html('')
        })
        const successPopup = {
            position: 'center',
            icon: 'success',
            title: 'Thành công!',
            showConfirmButton: false,
            timer: 1500
        }
        const confirmPopup = {
            title: 'Bạn chắc chắn muốn xóa sản phẩm này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, đồng ý!',
            cancelButtonText: 'Đóng!'
        }
        const priceFormatOption = {
            useGrouping: true,
            maximumFractionDigits: 0,
        }
        $(".register-form").on("submit", function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            let flag = true;
            $('.res-email-err-msg').html('')
            $('.res-pass-err-msg').html('')
            if ($(this)[0][0].value.trim() == '') {
                $('.res-email-err-msg').html('Vui lòng nhập email...')
                flag = false
            } else if (!(/\S+@\S+\.\S+/.test($(this)[0][0].value))) {
                $('.res-email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if ($(this)[0][1].value.trim().length < 6) {
                $('.res-pass-err-msg').html('Mật khẩu tối thiểu 6 ký tự...')
                flag = false
            }
            if ($(this)[0][1].value != $(this)[0][2].value) {
                $('.res-cfpass-err-msg').html('Mật khẩu nhập lại không trùng khớp...')
                flag = false
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/auth/register',
                    data: formData,
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: 'Đăng ký thành công'
                            })
                            $('#signin-2').addClass('show active')
                            $('#signin-tab-2').addClass('active')
                            $('#register-2').removeClass('show active')
                            $('#register-tab-2').removeClass('active')
                        } else {
                            $('.res-email-err-msg').html('Email đã tồn tại...')
                        }
                    },
                });
            }
        });
        $(".login-form").on("submit", function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            let flag = true
            $('.login-email-err-msg').html('')
            $('.login-pass-err-msg').html('')
            if ($(this)[0][0].value.trim() == '') {
                $('.login-email-err-msg').html('Vui lòng nhập email...')
                flag = false
            }
            if ($(this)[0][1].value.trim() == '') {
                $('.login-pass-err-msg').html('Vui lòng nhập mật khẩu...')
                flag = false
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/auth/login',
                    data: formData,
                    success: function(response) {
                        response = JSON.parse(response)
                        if (typeof response == 'object') {
                            window.location = '/';
                        } else {
                            Swal.fire({
                                ...successPopup,
                                icon: 'error',
                                title: 'Email hoặc mật khẩu không chính xác!'
                            })
                        }
                    },
                });
            }

        });
        // add to cart
        function addToCart(id, quantity, size, color) {
            $.ajax({
                type: 'POST',
                url: '/cart/add',
                data: {
                    id,
                    quantity,
                    size,
                    color
                },
                success: function(response) {
                    if (response && JSON.parse(response).loginStatus == true) {
                        updateCartHeader(response)
                        Swal.fire({
                            ...successPopup,
                            title: 'Đã thêm sản phẩm vào giỏ hàng!',
                        })
                    } else {
                        window.location = "/auth"
                    }
                },
            });
        }
        // update ui cart - header
        function updateCartHeader(response) {
            let cartHTML = ''
            const {
                cart,
                total,
                totalQuantity
            } = JSON.parse(response)
            if (cart) {
                for (const key in cart) {
                    const {
                        id: productId,
                        title,
                        currentPrice,
                        quantity,
                        image,
                        colors,
                        colorSelected,
                        sizes,
                        sizeSelected
                    } = cart[key]
                    cartHTML += `<div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="/product/detail/${productId}">${title}</a>
                                    </h4>
                                    <div class="cart-product-info">
                                        <span class="cart-product-qty circle active" style="background-color: ${colorSelected}; width: 15px; height: 15px; margin-left: 4px;"></span>
                                        - ${sizeSelected}
                                    </div>
                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">${quantity}</span>
                                        x ${currentPrice}đ
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="/product/detail/${productId}" class="product-image">
                                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/${image}" alt="${title}">
                                    </a>
                                </figure>
                            </div><!-- End .product -->`
                }
            }
            $('.dropdown-cart-products').html(cartHTML);
            if (total > -1) {
                $('.cart-total-price').html(`${total.toLocaleString('en-US', priceFormatOption)}đ`);
                $('.cart-txt').html(`${total.toLocaleString('en-US', priceFormatOption)}đ`);
            }
            if (totalQuantity > -1) {
                $('.cart-count').html(`${totalQuantity < 99 ? totalQuantity.toLocaleString('en-US', priceFormatOption) : '...'}`);
            }
        }
        // update ui cart - cart page
        function updateCartPage(response) {
            let cartHTML = ''
            const {
                cart,
                total,
            } = JSON.parse(response)
            if (total > 0) {
                if (cart) {
                    for (const key in cart) {
                        const {
                            id: productId,
                            title,
                            currentPrice,
                            quantity,
                            image,
                            colors,
                            colorSelected,
                            sizes,
                            sizeSelected
                        } = cart[key]
                        let colorHTML = ''
                        let sizeHTML = ''
                        colors.forEach(c => {
                            let isActive = c.color == colorSelected ? 'active' : ''
                            colorHTML += `<span class="circle2 ${isActive}" style="background-color: ${c.color}" data-color="${c.color}" data-product-id="${productId}"></span>`
                        })
                        for (const key in sizes) {
                            sizes[key].forEach(item => {
                                let isVisible = key == colorSelected ? '' : 'd-none'
                                let isSelected = item.size == sizeSelected ? 'selected' : ''
                                sizeHTML += `<option class="${isVisible}" value="${item.size}" ${isSelected} data-color="${key}">${item.size}</option>`
                            })
                        }
                        cartHTML += ` <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="/product/detail/${productId}">
                                                        <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/${image}" alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="/product/detail/${productId}">${title.length > 20 ? title.slice(0,20)+'...': title}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">${currentPrice}đ</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input type="number" class="form-control" name="quantity[]" value="${quantity}" min="1" step="1" data-decimals="0" required>
                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                ${colorHTML}
                                                <input type="hidden" id="color-selected" data-product-id="${productId}" name="colorSelected[]" value="${colorSelected}">
                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <select name="sizeSelected[]" class="form-control size-select">
                                                    ${sizeHTML}
                                                </select>
                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <td class="total-col">${(currentPrice * quantity).toLocaleString('en-US', priceFormatOption)}đ</td>
                                        <td class="remove-col"><button type="button" class="btn-remove" onclick="deleteCartItem(${productId}, '${sizeSelected}', '${colorSelected}')"><i class="icon-close"></i></button></td>
                                    </tr>`
                    }
                }
                $('.cart-tbody').html(cartHTML);
                $('.summary-subtotal-text').html(`${total.toLocaleString('en-US', priceFormatOption)}đ`);
                $(document).on("click", ".circle2", function() {
                    var productId = $(this).data('product-id');
                    var color = $(this).data('color');
                    $(this).siblings('.circle2').removeClass('active');
                    $(this).addClass('active');
                    $('input[type="hidden"][data-product-id="' + productId + '"]').val($(this).data('color'));
                    var tableRow = $(this).parents().eq(2)
                    var selectTag = tableRow.find('.cart-product-size .size-select')
                    console.log(selectTag.find('option'));
                    selectTag.find('option').addClass('d-none')
                    selectTag.find('option[data-color="' + color + '"]').removeClass('d-none')
                    selectTag.val(selectTag.find('option').not('.d-none')[0].value)
                });
                if ($.fn.inputSpinner) {
                    $("input[type='number']").inputSpinner({
                        decrementButton: '<i class="icon-minus"></i>',
                        incrementButton: '<i class="icon-plus"></i>',
                        groupClass: "input-spinner",
                        buttonsClass: "btn-spinner",
                        buttonsWidth: "26px",
                    });
                }
            } else {
                $('.row.cart-wrapper').html(` <div class="m-auto text-center">
                        <h2 class="">Chưa có sản phẩm nào trong giỏ hàng</h2>
                        <a href="/product" class="btn btn-outline-primary">Mua sắm ngay</a>
                    </div>`);
            }
        }

        // validate input number có kết hợp với thư viện input spinner 
        $("input[type='number']").on('input', function() {
            $(this).attr('value', 1)
        })
        // submit update cart -> cart page
        $("#cart-form").on("submit", function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '/cart/update',
                data: formData,
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        updateCartHeader(response)
                        updateCartPage(response)
                        Swal.fire({
                            ...successPopup,
                            title: 'Cập nhật giỏ hàng thành công!',
                        })
                    }

                },
            });

        });
        // delete cart item
        function deleteCartItem(id, size, color) {
            Swal.fire({
                ...confirmPopup
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: `/cart/delete`,
                        data: {
                            id,
                            color,
                            size
                        },
                        success: function(response) {
                            if (response) {
                                updateCartHeader(response)
                                updateCartPage(response)
                                Swal.fire({
                                    ...successPopup,
                                    title: 'Xóa sản phẩm thành công!',
                                })
                            }
                        },
                    });
                }
            })
        }
        $('.btn-clear-cart').on('click', function() {
            Swal.fire({
                ...confirmPopup,
                title: 'Bạn có chắc muốn xóa sạch giỏ hàng'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: '/cart/clear',
                        success: function(response) {
                            if (response && JSON.parse(response) != 'failed') {
                                updateCartHeader(response)
                                updateCartPage(response)
                                Swal.fire({
                                    ...successPopup,
                                    title: 'Giỏ hàng đã được xóa sạch!'
                                })
                            }
                        },
                    });
                }
            })

        })
        // chọn màu giỏ hàng
        $('.circle2').on('click', function() {
            var productId = $(this).data('product-id');
            var color = $(this).data('color');
            $(this).siblings('.circle2').removeClass('active');
            $(this).addClass('active');
            $('input[type="hidden"][data-product-id="' + productId + '"]').val($(this).data('color'));
            var tableRow = $(this).parents().eq(2)
            var selectTag = tableRow.find('.cart-product-size .size-select')
            var input = tableRow.find('.cart-product-quantity input')
            selectTag.find('option').addClass('d-none')
            selectTag.find('option[data-color="' + color + '"]').removeClass('d-none')
            console.log(selectTag.find('option').not('.d-none')[0].value);
            selectTag.val(selectTag.find('option').not('.d-none')[0].value)
            // input.attr('max', selectTag.find('option').not('.d-none')[0].dataset.qty)
        });

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
            $('.left-quantity').html(`Sản phẩm còn lại: ${leftQty}`)
            $('#qty').attr('max', leftQty)
            if (leftQty == 0) {
                $('.product-details-action').html(`<div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist" onclick="addtoWishlist('${productId}')"><span>Thêm vào danh sách yêu thích</span></a>
                                </div>`)
            } else {
                $('.product-details-action').html(`
                <a href="javascript:void(0)" class="btn-product btn-cart" onclick="addToCartDetail('${productId}')"><span>Thêm vào giỏ hàng</span></a>
                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist" onclick="addtoWishlist('${productId}')"><span>Thêm vào danh sách yêu thích</span></a>
                                </div>`)
            }
            console.log($('.size-select option').not('.d-none')[0].dataset.quantity);
        });
        $('.size-select').on('change', function() {
            const quantity = $('.size-select option:selected').data('quantity')
            $('.left-quantity').html(`Sản phẩm còn lại: ${quantity}`)
            $('#qty').attr('max', quantity)
        })
        $('.star').on('click', function() {
            var starValue = $(this).data('value');
            $('.star').removeClass('yellow');
            $(this).prevAll().addBack().addClass('yellow');
            $('#stars').val(starValue);
        });
        // submit đánh giá
        $('#review-form').on('submit', function(e) {
            e.preventDefault()
            let flag = true
            if ($('#title').val().trim() == '') {
                flag = false
                $('.title-err-msg').html('Chưa nhập tiêu đề đánh giá...')
            }
            if ($('#stars').val().trim() == '') {
                flag = false
                $('.stars-err-msg').html('Chưa chọn số sao...')
            }
            if ($('#content').val().trim() == '') {
                flag = false
                $('.content-err-msg').html('Chưa nhập nội dung đánh giá...')
            }
            if (flag) {
                const formData = $(this).serialize()
                $.ajax({
                    type: 'POST',
                    url: '/product/addReview',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            updateReview(response)
                            Swal.fire({
                                ...successPopup,
                                title: 'Đánh giá của bạn đã được gửi đi',
                            })
                            $('#content').val('')
                            $('#stars').val('')
                            $('.star').removeClass('yellow');
                            $('#title').val('')
                            $('.err-msg').html()
                        }
                    },
                });
            }
        })

        function updateReview(response) {
            const {
                reviews
            } = JSON.parse(response)
            let reviewsHTML = ''
            if (reviews) {
                for (const key in reviews) {
                    const {
                        fname,
                        lname,
                        email,
                        star,
                        content,
                        title,
                        reviewTime
                    } = reviews[key]
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
                                        <h4>${title}</h4>

                                        <div class="review-content">
                                            <p>${content}</p>
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
            $('.review-count').html(`Đánh giá (${Object.keys(reviews).length})`)
        }
        // add to cart - product detail page
        function addToCartDetail(id) {
            console.log(id, $('#qty').val(), $('.size-select').val(), $('.colorSelected').val());
            addToCart(Number(id), Number($('#qty').val()), $('.size-select').val(), $('.colorSelected').val())
        }
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
                                                <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="addtoWishlist('${productId}')"><span>Thêm vào danh sách yêu thích</span></a>
                                                <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview btn-expandable" title="Quick view"><span>quick view</span></a> -->
                                            </div><!-- End .product-action-vertical -->

                                            <div class="product-action">
                                                <a href="javascript:void(0)" onclick="addToCart('${productId}',1,'${size}','${color}')" class="btn-product btn-cart"><span>Thêm vào giỏ hàng</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="/product/detail/${productId}">${title}</a></h3><!-- End .product-title -->
                                            <div class="product-price">
                                                ${Number(currentPrice).toLocaleString('en-US', priceFormatOption)}đ
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
            $(document).on("click", ".page-item", function(e) {
                e.preventDefault()
                if (!$(e.target).parent().hasClass('active')) {
                    $(e.target).parent().siblings().removeClass('active')
                    $(e.target).parent().addClass('active')
                    callFilterProducts()
                }
            });
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
        if ($("#province").length) {
            const host = "https://provinces.open-api.vn/api/";
            var callAPI = (api) => {
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response, "province");
                    callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
                });
            };
            callAPI("https://provinces.open-api.vn/api/?depth=1");
            var callApiDistrict = (api) => {
                $("#province-is").val(
                    $(`#province option[value="${$("#province").val()}"]`).data("name")
                );
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response.districts, "district");
                    callApiWard(host + "d/" + $("#district").val() + "?depth=2");
                });
            };
            var callApiWard = (api) => {
                $("#district-is").val(
                    $(`#district option[value="${$("#district").val()}"]`).data("name")
                );
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response.wards, "ward");
                    $("#ward-is").val(
                        $(`#ward option[value="${$("#ward").val()}"]`).data("name")
                    );
                });
            };

            var renderData = (array, select) => {
                let row = "";
                const postition = JSON.parse(localStorage.getItem("address"));

                array.forEach((element, index) => {
                    if (postition) {
                        row += `<option value="${element.code}" ${
            postition[select] && postition[select] == element.name ? "selected" : null
          } data-name="${element.name}">${element.name}</option>`;
                    } else {
                        row += `<option value="${element.code}" data-name="${element.name}">${element.name}</option>`;
                    }
                });
                $("#" + select).html(row);
            };

            $("#province").change(function() {
                callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
            });
            $("#district").change(function() {
                callApiWard(host + "d/" + $("#district").val() + "?depth=2");
            });
            $("#ward").change(function() {
                $("#ward-is").val($(`#ward option[value="${$("#ward").val()}"]`).data("name"));
            });
        }
        // submit checkout
        $('#checkout-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            let flag = true;
            let min = 2
            let max = 50
            $('.err-msg').html('')
            if (checkIsEmpty($(this).find('#fname').val())) {
                $('.co-fname-err-msg').html('Please enter first name...')
                flag = false
            } else if (!checkName($(this).find('#fname').val(), min, max)) {
                $('.co-fname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }

            if (checkIsEmpty($(this).find('#lname').val())) {
                $('.co-lname-err-msg').html('Please enter last name...')
                flag = false
            } else if (!checkName($(this).find('#lname').val(), min, max)) {
                $('.co-lname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }

            if (!checkEmail($(this).find('#email').val())) {
                $('.co-email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if (!checkPhone($(this).find('#phone').val())) {
                $('.co-phone-err-msg').html('Số điện thoại không hợp lệ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#street').val())) {
                $('.co-street-err-msg').html('Chưa nhập tên đường và số nhà...')
                flag = false
            }
            if (flag) {
                Swal.fire({
                    title: 'Đang xử lý, vui lòng đợi...!',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    type: 'POST',
                    url: '/checkout/complete',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: 'Thanh toán thành công!',
                            })
                            $('.checkout .container').html(`<a href="/" class="btn btn-outline-primary-2 btn-minwidth-lg d-block text-center">
            			<span>Quay về trang chủ</span>
            			<i class="icon-long-arrow-right"></i>
            		</a>`);
                            updateCartHeader(response)
                        }
                    },
                });
            }

        })
        const defaultNumbers = ' hai ba bốn năm sáu bảy tám chín';
        const chuHangDonVi = ('1 một' + defaultNumbers).split(' ');
        const chuHangChuc = ('lẻ mười' + defaultNumbers).split(' ');
        const chuHangTram = ('không một' + defaultNumbers).split(' ');

        function convert_block_three(number) {
            if (number == '000') return '';
            var _a = number + ''; //Convert biến 'number' thành kiểu string

            //Kiểm tra độ dài của khối
            switch (_a.length) {
                case 0:
                    return '';
                case 1:
                    return chuHangDonVi[_a];
                case 2:
                    return convert_block_two(_a);
                case 3:
                    var chuc_dv = '';
                    if (_a.slice(1, 3) != '00') {
                        chuc_dv = convert_block_two(_a.slice(1, 3));
                    }
                    var tram = chuHangTram[_a[0]];
                    if (tram !== 'không') {
                        tram += ' trăm';
                    }
                    return tram + ' ' + chuc_dv;
            }
        }

        function convert_block_two(number) {
            var dv = chuHangDonVi[number[1]];
            var chuc = chuHangChuc[number[0]];
            var append = '';

            // Nếu chữ số hàng đơn vị là 5
            if (number[0] > 0 && number[1] == 5) {
                dv = 'lăm';
            }

            // Nếu số hàng chục lớn hơn 1
            if (number[0] > 1) {
                append = ' mươi';
                if (number[1] == 1) {
                    dv = ' mốt';
                }
            }

            return chuc + '' + append + ' ' + dv;
        }
        const dvBlock = '1 nghìn triệu tỷ'.split(' ');

        function to_vietnamese(number) {
            var str = parseInt(number) + '';
            var i = 0;
            var arr = [];
            var index = str.length;
            var result = [];
            var rsString = '';

            if (index == 0 || str == 'NaN') {
                return '';
            }

            // Chia chuỗi số thành một mảng từng khối có 3 chữ số
            while (index >= 0) {
                arr.push(str.substring(index, Math.max(index - 3, 0)));
                index -= 3;
            }

            // Lặp từng khối trong mảng trên và convert từng khối đấy ra chữ Việt Nam
            for (i = arr.length - 1; i >= 0; i--) {
                if (arr[i] != '' && arr[i] != '000') {
                    result.push(convert_block_three(arr[i]));

                    // Thêm đuôi của mỗi khối
                    if (dvBlock[i]) {
                        result.push(dvBlock[i]);
                    }
                }
            }

            // Join mảng kết quả lại thành chuỗi string
            rsString = result.join(' ');

            // Trả về kết quả kèm xóa những ký tự thừa
            return rsString.replace(/[0-9]/g, '').replace(/ /g, ' ').replace(/ $/, '');
        }
        $(document).ready(function() {
            let totalPrice = $('.total-price').text().split('đ')[0].replace(',', '');
            $('.price-to-words').html('Bằng chữ: <b class="text-uppercase">' + to_vietnamese(totalPrice) + ' đồng</b>');
        });
        // các hàm validate form
        function checkIsEmpty(value) {
            return value.trim() == ''
        }

        function checkName(value, min = 0, max = 0) {
            value = value.trim();
            return value.length >= min && value.length <= max && /^([^0-9]*)$/.test(value)
        }

        function checkEmail(email) {
            return (/\S+@\S+\.\S+/.test(email.trim()))
        }

        function checkPhone(phone) {
            return /^[0]([0-9]){9,10}$/.test(phone);
        }
        // kết thúc các hàm validate form
        // account - change user info form submit 
        $('#account-form').on('submit', function(e) {
            e.preventDefault();
            let flag = true;
            let min = 2
            let max = 50
            if (checkIsEmpty($(this).find('#fname').val())) {
                $('.ci-fname-err-msg').html('Vui lòng nhập họ...')
                flag = false
            } else if (!checkName($(this).find('#fname').val(), min, max)) {
                $('.ci-fname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }
            if (checkIsEmpty($(this).find('#lname').val())) {
                $('.ci-lname-err-msg').html('Chưa nhập tên...')
                flag = false
            } else if (!checkName($(this).find('#lname').val(), min, max)) {
                $('.ci-lname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }

            if (!checkEmail($(this).find('#email').val())) {
                $('.ci-email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if (!checkPhone($(this).find('#phone').val())) {
                $('.ci-phone-err-msg').html('Số điện thoại không hợp lệ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#street').val())) {
                $('.ci-street-err-msg').html('Chưa nhập tên đường và số nhà...')
                flag = false
            }
            if (flag) {
                var formData = new FormData();
                formData.append("fname", $('#fname').val().trim())
                formData.append("lname", $('#lname').val().trim())
                formData.append("phone", $('#phone').val().trim())
                formData.append("province-is", $('#province-is').val().trim())
                formData.append("district-is", $('#district-is').val().trim())
                formData.append("ward-is", $('#ward-is').val().trim())
                formData.append("street", $('#street').val().trim())
                formData.append("avatar", $('#avatar')[0].files[0])
                $.ajax({
                    type: 'POST',
                    url: '/account/update',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            $('#header-avatar').attr('src', JSON.parse(response).avatar)
                            Swal.fire(successPopup)
                        } else if (response && JSON.parse(response).status == 0) {
                            if(JSON.parse(response).uploadErr){
                                $('.avatar-err-msg').html(JSON.parse(response).uploadErr)
                            }
                        }
                    },
                });
            }

        })
        // account - change password form submit 
        $('#password-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            let flag = true;
            $('.ci-password-err-msg').html('')
            $('.ci-new-password-err-msg').html('')
            $('.ci-cfpassword-err-msg').html('')
            let min = 6
            if (checkIsEmpty($(this).find('#password').val())) {
                $('.ci-password-err-msg').html('Chưa nhập mật khẩu cũ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#new-password').val())) {
                $('.ci-new-password-err-msg').html('Chưa nhập mật khẩu mới...')
                flag = false
            } else if ($(this).find('#new-password').val().length < min) {
                $('.ci-new-password-err-msg').html(`Mật khẩu tối thiểu ${min} ký tự...`)
                flag = false
            } else if ($(this).find('#new-password').val() == $(this).find('#password').val()) {
                $('.ci-new-password-err-msg').html(`Mật khẩu mới không được trùng với mật khẩu cũ...`)
                flag = false
            }

            if ($(this).find('#cfpassword').val() !== $(this).find('#new-password').val()) {
                $('.ci-cfpassword-err-msg').html('Nhập lại mật khẩu không khớp...')
                flag = false
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/account/cpassword',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 0) {
                            if (JSON.parse(response).message) {
                                $('.ci-password-err-msg').html(JSON.parse(response).message)
                            } else {
                                Swal.fire({
                                    ...successPopup,
                                    icon: 'error',
                                    title: 'Đã có lỗi xảy ra',
                                })
                            }
                        } else if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: 'Đã thay đổi mật khẩu thành công!',
                            })
                            $('input').val('');
                        }
                    },
                });
            }

        })
        // trả hàng
        $('.return-form').on('submit', handleReturn)

        function handleReturn(e) {
            e.preventDefault()
            let flag = true
            const _this = $(this)
            const td = _this.parents('td')
            const reason = $(this).find('textarea[name="reason"]');
            const images = $(this).find('input[type="file"]');
            if (reason.val().trim() == '') {
                flag = false
                reason.siblings('.err-msg').html("Bạn chưa nhập lý do trả hàng...")
            }
            if (images[0].files.length <= 0) {
                flag = false
                images.siblings('.err-msg').html("Bạn chưa cung cấp hình ảnh...")
            }
            const formData = new FormData()
            formData.append('orderId', _this.find('input[name="orderId"]').val());
            formData.append('optionId', _this.find('input[name="optionId"]').val());
            formData.append('image', _this.find('input[name="image"]')[0].files[0]);
            formData.append('reason', _this.find('textarea[name="reason"]').val());
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/account/returns',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                timer: false,
                                showConfirmButton: true,
                                title: 'Yêu cầu đã được xử lý...'
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    },
                });
            }
        }
        // hủy đơn
        function cancelOrder(orderId) {
            if (orderId) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Hủy đơn hàng này ?'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/account/cancelOrder`,
                            data: {
                                orderId
                            },
                            success: function(response) {
                                if (response) {
                                    updateAccountOrderList(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Đã hủy đơn hàng thành công!',
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateAccountOrderList(response) {
            const {
                orders
            } = JSON.parse(response)
            let _html = ''
            if (orders) {
                for (const key in orders) {
                    let _btn = ''
                    const {
                        orderId,
                        orderDate,
                        summary,
                        status,
                        statusText
                    } = orders[key]
                    if (status == 1) {
                        _btn += `<button class="btn btn-primary" onclick="cancelOrder('${orderId}')">Hủy đơn</button>`
                    }
                    _html += `
                    <tr>
                                                    <td class="p-2">#
                                                        ${orderId}
                                                    </td>
                                                    <td class="p-2">
                                                        ${orderDate}
                                                    </td>
                                                    <td class="p-2">
                                                        ${summary.toLocaleString('en-US', priceFormatOption)}đ
                                                    </td>
                                                    <td class="p-2">
                                                       ${statusText}
                                                    </td>
                                                    <td class="p-2">
                                                        ${_btn}
                                                        <a href="/account/odt/${orderId}" class="btn btn-custom btn-outline-primary">Chi tiết</a>
                                                    </td>
                                                </tr>
                    `
                }
            }
            $('.order-list').html(_html)
            $(document).on('submit', '.return-form', handleReturn);
        }
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
        // submit contact form
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            let flag = true;
            let min = 2
            let max = 50
            $('.err-msg').html('')
            if (checkIsEmpty($(this).find('#name').val())) {
                $('.ct-name-err-msg').html('Vui lòng nhập họ...')
                flag = false
            } else if (!checkName($(this).find('#name').val(), min, max)) {
                $('.ct-name-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }

            if (!checkEmail($(this).find('#email').val())) {
                $('.ct-email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if (!checkPhone($(this).find('#phone').val())) {
                $('.ct-phone-err-msg').html('Số điện thoại không hợp lệ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#message').val())) {
                $('.ct-mess-err-msg').html('Chưa nhập nội dung...')
                flag = false
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/contact/add',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: 'Tin nhẵn của bạn đã được gửi!',
                            })
                        }
                    },
                });
            }
        })
        // wishlist
        function addtoWishlist(productId) {
            $.ajax({
                type: 'POST',
                url: '/wishlist/add',
                data: {
                    productId
                },
                success: function(response) {
                    const {
                        status
                    } = JSON.parse(response)
                    if (status == 1) {
                        updateWishlistHeader()
                        Swal.fire({
                            ...successPopup,
                            title: 'Đã thêm vào danh sách yêu thích!',
                        })
                    } else {
                        if (JSON.parse(response).errMsg) {
                            Swal.fire({
                                ...successPopup,
                                icon: 'info',
                                title: JSON.parse(response).errMsg,
                            })
                        }
                    }
                },
            });
        }

        function updateWishlistHeader() {
            $.ajax({
                type: 'POST',
                url: '/wishlist/total',
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        $('.wishlist-count').html(JSON.parse(response).total[0])
                    }
                },
            });
        }

        function updateWishlistPage(response) {
            const {
                wishlist
            } = JSON.parse(response)
            let _html = ''
            if (wishlist.length > 0) {
                wishlist.forEach(item => {
                    _html += `
                <tr>
                                            <td class="product-col">
                                                <input type="hidden" name="id[]" value="${item.productId}">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="/public/assets/images/products/${item.image}" alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="/product/detail/">${item.title.length > 20 ? item.title.substring(0,20)+'...' : item.title}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td>${item.originalPrice}đ</td>
                                            <td>${item.salePercent}%</td>
                                            <td>${item.currentPrice}đ</td>
                                            <td class="remove-col"><button type="button" class="btn-remove" onclick="deleteWishlistItem('${item.productId}')"><i class="icon-close"></i></button></td>
                                        </tr>
                `
                })
                $('.wishlist-tbody').html(_html)
            } else {
                $('.cart-wrapper').html(`
                <div class="m-auto text-center">
                        <h2 class="">Chưa có sản phẩm nào trong danh sách yêu thích của bạn</h2>
                        <a href="/product" class="btn btn-outline-primary">Mua sắm ngay</a>
                    </div>`)
            }

        }

        function deleteWishlistItem(productId = null) {
            let popup = {
                ...confirmPopup
            }
            let option = {
                type: 'POST',
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        updateWishlistPage(response)
                        updateWishlistHeader()
                        // Swal.fire({
                        //     ...successPopup,
                        //     title: 'Danh sách yêu thích trống!',
                        // })
                    }
                },
            }
            if (productId) {
                popup.title = 'Bạn muốn xóa sản phẩm này khỏi danh sách yêu thích ?'
                option.data = {
                    productId
                }
                option.url = '/wishlist/delete'
            } else {
                popup.title = 'Bạn muốn xóa tất cả sản phẩm khỏi danh sách yêu thích ?'
                option.url = '/wishlist/deleteAll'
            }
            Swal.fire({
                ...confirmPopup,
                title: 'Bạn muốn xóa tất cả sản phẩm khỏi danh sách yêu thích ?'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax(option);
                }
            })

        }
        $(document).ready(function() {
            updateWishlistHeader()
        });
        // quên mật khẩu
        function handleSubmitEmail() {
            $('.err-msg').html('')
            var currentDate = new Date();
            currentDate.setMinutes(currentDate.getMinutes() + 5);
            const y = currentDate.getFullYear()
            const m = currentDate.getMonth() + 1
            const d = currentDate.getDate()
            const h = currentDate.getHours()
            const i = currentDate.getMinutes()
            const s = currentDate.getSeconds()
            const email = $('#email').val();
            if (checkEmail(email) && email.length < 50) {
                Swal.fire({
                    title: 'Đang xử lý, vui lòng đợ...!',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    type: 'POST',
                    url: '/auth/generateToken',
                    data: {
                        email
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.close()
                            $('.inputs').html(`
                            <p>Mã xác nhận đã được gửi đến email của bạn!</p>
                            <div class="coming-countdown countdown-separator"></div>
                                <div class="form-group">
                        <label for="token" class="form-label mt-2">Nhập mã xác nhận</label>
                        <input type="hidden" name="email" id="email" class="form-control" value="${email}" readonly>
                        <input type="text" name="token" id="token" class="form-control">
                        <div class="err-msg token-err-msg"></div>
                        <button class="btn btn-outline-primary mt-2" onclick="handleSubmitToken()">Xác nhận đổi mật khẩu</button>
                    </div>
                            `)
                            if ($.fn.countdown) {
                                $('.coming-countdown').countdown({
                                    until: new Date(currentDate), // 7th month = August / Months 0 - 11 (January  - December)
                                    format: 'MS',
                                    padZeroes: true
                                });
                            }
                        } else {
                            if (response && JSON.parse(response).errMsg) {
                                $('.email-err-msg').html(JSON.parse(response).errMsg)
                            }
                        }
                    },
                });
            } else {
                $('.email-err-msg').html('Email không hợp lệ, vui lòng kiểm tra lại...')
            }
        }

        function handleSubmitToken() {
            $('.err-msg').html('')
            const token = $('#token').val().trim()
            const email = $('#email').val().trim()
            if (token == '' || email == '') {
                $('.email-err-msg').html('Vui lòng nhập mã xác nhận...')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/auth/checkToken',
                    data: {
                        token,
                        email
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            $('.inputs').html(`
                            <input type="hidden" name="email" id="email" class="form-control" readonly value="${email}">
                            <div class="form-group">
                        <label for="password" class="form-label">Nhập mật khẩu mới</label>
                        <input type="text" name="password" id="password" class="form-control">
                        <div class="err-msg password-err-msg"></div>
                    </div>
                    <div class="form-group">
                        <label for="cfpass" class="form-label">Nhập lại mật khẩu</label>
                        <input type="text" name="cfpass" id="cfpass" class="form-control">
                        <div class="err-msg cfpass-err-msg"></div>
                    </div>
                    <div class="form-group">
                    <button class="btn btn-outline-primary mt-2" onclick="handleSubmitPassword()">Gửi mã đến email</button>
                    </div>
                            `)
                        } else {
                            $('.token-err-msg').html(JSON.parse(response).errMsg)
                        }
                    },
                });
            }
        }

        function handleSubmitPassword() {
            $('.err-msg').html('')
            let flag = true
            const password = $('#password').val().trim()
            const cfpass = $('#cfpass').val().trim()
            const email = $('#email').val().trim()
            if (password.length < 6) {
                flag = false
                $('.password-err-msg').html('Mật khẩu tối thiểu 6 ký tự')
            }
            if (password != cfpass) {
                flag = false
                $('.cfpass-err-msg').html('Mật khẩu nhập lại không khớp')
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/auth/changePassword',
                    data: {
                        password,
                        email
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            $('.main-content').html(`
                            <a class="btn btn-outline-primary" href="/auth">Đến trang đăng nhập</a>
                            <a class="btn btn-outline-primary" href="/">Quay về trang chủ</a>
                            `)
                            Swal.fire({
                                ...successPopup,
                                title: 'Đổi mật khẩu thành công !'
                            })
                        } else {
                            Swal.fire({
                                ...successPopup,
                                icon: 'error',
                                title: 'Có lỗi xảy ra !'
                            })
                        }
                    },
                });
            }
        }
        // phân trang tin tức

        function paginateBlogs(page = null) {
            if (page == null) {
                page = $('.page-item.active a').attr('href').split('')[1];
            }
            $.ajax({
                type: 'POST',
                url: '/blog/paginate',
                data: {
                    page
                },
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        updateBlogPage(response)
                    }
                },
            });
        }

        function updateBlogPage(response) {
            const {
                totalBlogsFound,
                blogs,
                totalPage,
                currentPage
            } = JSON.parse(response)
            let _html = ''
            for (const key in blogs) {
                const {
                    blogId,
                    author,
                    createdAt,
                    commentsCount,
                    title,
                    shortDesc,
                    thumbnail
                } = blogs[key]
                _html += `
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
            $('.blogs-container').html(_html)
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
            $(document).on("click", ".page-item", function(e) {
                e.preventDefault()
                if (!$(e.target).parent().hasClass('active')) {
                    $(e.target).parent().siblings().removeClass('active')
                    $(e.target).parent().addClass('active')
                    paginateBlogs()
                }
            });
        }
        // fb auth 
        $("#fb-auth-form").on('submit', function(e) {
            e.preventDefault();
            $('.err-msg').html('')
            if (!checkEmail($('#email').val())) {
                $('.email-err-msg').html('Email không hợp lệ...')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '/auth/fbAuth',
                    data: {
                        email: $('#email').val().trim()
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            console.log('Success');
                        }
                    },
                });
            }
        })
    </script>
</body>

</html>
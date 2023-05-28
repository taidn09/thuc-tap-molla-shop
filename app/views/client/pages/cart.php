
<?php 
    echo '<pre>';
    // print_r($_SESSION['cart']);
    echo '</pre>';
?>
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/product">Cửa hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row cart-wrapper">

                <?php
                if (count($_SESSION['cart']) > 0) :
                ?>
                    <form action="" method="post" id="cart-form" class="col-lg-12">
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Màu sắc</th>
                                    <th>Kích cỡ</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="cart-tbody">
                                <?php
                                if (!empty($_SESSION['cart'])) :
                                    foreach ($_SESSION['cart'] as $key => $item) :
                                ?>
                                        <tr>
                                            <td class="product-col">
                                                <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $item['image'] ?>" alt="Product image">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="/product/detail/<?= $item['id'] ?>"><?= strlen($item['title']) > 20 ? substr($item['title'], 0, 20) . '...' : $item['title'] ?></a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col"><?= number_format($item['currentPrice']) ?>đ</td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control" name="quantity[]" value="<?= !empty($item['quantity']) ? $item['quantity'] : 1 ?>" min="1"  step="1" data-decimals="0">
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <?php
                                                    if (!empty($item['colors'])) :
                                                        foreach ($item['colors'] as $color) :
                                                    ?>
                                                            <span class="circle2 <?= $color['color'] ?> <?= $item['colorSelected'] == $color['color'] ? 'active' : '' ?>" style="background-color:<?= $color['color'] ?>  ;" data-color="<?= $color['color'] ?>" data-product-id="<?= $item['id'] ?>"></span>
                                                    <?php endforeach;
                                                    endif; ?>
                                                    <input type="hidden" data-product-id="<?= $item['id'] ?>" name="colorSelected[]" value="<?= $item['colorSelected'] ?>">
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
                                            <td class="quantity-col">
                                                <div class="cart-product-size">
                                                    <select name="sizeSelected[]" class="form-control size-select">
                                                        <?php
                                                        if (!empty($item['sizes'])) :
                                                            foreach ($item['sizes'] as $key => $size) :
                                                                foreach ($size as $sizeItem) :
                                                        ?>
                                                                    <option class="<?= $key == $item['colorSelected'] ? "" : 'd-none' ?>" value="<?= $sizeItem['size'] ?>" <?= $sizeItem['size'] == $item['sizeSelected'] ? "selected" : '' ?> data-color="<?= $key ?>" data-qty="<?= $sizeItem['quantity'] ?>"><?= $sizeItem['size'] ?></option>
                                                        <?php endforeach;
                                                            endforeach;
                                                        endif; ?>
                                                    </select>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
                                            <td class="total-col"><?= number_format($item['currentPrice'] * $item['quantity']) ?>đ</td>
                                            <td class="remove-col"><button type="button" class="btn-remove" onclick="deleteCartItem('<?= $item['id'] ?>','<?= $item['sizeSelected'] ?>','<?= $item['colorSelected'] ?>')"><i class="icon-close"></i></button></td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <!-- <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                            <!-- End .cart-discount -->
                            <a href="/product" class="btn btn-outline-primary">Tiếp tục mua sắm</a>
                            <button type="submit" class="btn btn-outline-dark-2"><span>Cập nhật giỏ hàng</span><i class="icon-refresh"></i></button>
                            <button type="button" class="btn-clear-cart btn btn-outline-dark-2"><span>Xóa tất cả sản phẩm</span><i class="icon-refresh"></i></button>
                        </div><!-- End .cart-bottom -->
                    </form><!-- End .col-lg-9 -->
                    <aside class="col-lg-12">
                        <div class="summary summary-cart">
                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-total">
                                        <td>Tổng thành tiền:</td>
                                        <td class="summary-subtotal-text"><?= !empty($_SESSION['cart-total-amount']) ? number_format($_SESSION['cart-total-amount']) : 0 ?>đ</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="/checkout" class="btn btn-outline-primary-2 btn-order btn-block">Tiến hành thanh toán</a>
                        </div><!-- End .summary -->
                        <a href="/product" class="btn btn-outline-dark-2 btn-block mb-3"><span>Tiếp tục mua hàng</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                <?php endif; ?>
                <?php if (count($_SESSION['cart']) <= 0) : ?>
                    <div class="m-auto text-center">
                        <h2 class="">Chưa có sản phẩm nào trong giỏ hàng</h2>
                        <a href="/product" class="btn btn-outline-primary">Mua sắm ngay</a>
                    </div>
                <?php endif; ?>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->

<script>
    window.addEventListener('DOMContentLoaded',function(){
        
    })
</script>
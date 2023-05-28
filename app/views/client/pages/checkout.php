<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/product">Cửa hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <!-- <div class="checkout-discount">
                    <form action="#">
                        <input autocomplete="off" type="text" class="form-control" id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div> -->
                <!-- End .checkout-discount -->
                <form action="/checkout/complete" id="checkout-form" method="POST">
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="checkout-title">Thông tin giao hàng</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="fname">Họ *</label>
                                    <input id="fname" autocomplete="off" type="text" name="fname" class="form-control" value="<?= !empty($_SESSION['user']['fname']) ? $_SESSION['user']['fname'] : '' ?>">
                                    <div class="co-fname-err-msg err-msg"></div>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="lname">Tên *</label>
                                    <input id="lname" autocomplete="off" type="text" name="lname" class="form-control" value="<?= !empty($_SESSION['user']['lname']) ? $_SESSION['user']['lname'] : '' ?>">
                                    <div class="co-lname-err-msg err-msg"></div>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="email">Email *</label>
                                    <input name="email" id="email" autocomplete="off" type="email" class="form-control" value="<?= !empty($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?>">
                                    <div class="co-email-err-msg err-msg"></div>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label for="phone">Số diện thoại *</label>
                                    <input name="phone" autocomplete="off" id="phone" type="tel" class="form-control" value="<?= !empty($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '' ?>">
                                    <div class="co-phone-err-msg err-msg"></div>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="province">Tỉnh / thành phố</label>
                                    <select class="form-control" name="province" id="province">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="district">Quận/ huyện</label>
                                    <select class="form-control" name="district" id="district">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ward">Phường / xã</label>
                                    <select class="form-control" name="ward" id="ward">
                                    </select>
                                </div>
                                <input autocomplete="off" type="hidden" name="province-is" id="province-is">
                                <input autocomplete="off" type="hidden" name="district-is" id="district-is">
                                <input autocomplete="off" type="hidden" name="ward-is" id="ward-is">
                            </div>
                            <label for="street">Tên đường - Số nhà</label>
                            <input autocomplete="off" type="text" id="street" value="<?= !empty($_SESSION['user']['street']) ? $_SESSION['user']['street'] : '' ?>" class="form-control" name="street">
                            <div class="co-street-err-msg err-msg"></div>
                            <label>Ghi chú (Không bắt buộc)</label>
                            <textarea name="notes" class="form-control" cols="30" rows="4" placeholder="Bạn có thể để lại ghi chú thêm cho chúng tôi..."></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-5">
                            <div class="summary">
                                <h3 class="summary-title">Đơn hàng của bạn</h3><!-- End .summary-title -->
                                <a href="/cart" class="text-right d-block mb-3">Quay lại giỏ hàng</a>
                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá tiền</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $productModel = new ProductModel();
                                        foreach ($_SESSION['cart'] as $product) {
                                            $quantityLeft = $productModel->getOption($product['id'], $product['sizeSelected'], $product['colorSelected'])['quantity'];
                                            $isValid = $quantityLeft >= $product['quantity'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <span class="d-flex align-items-center"><img src="<?php echo _WEB_ROOT; ?>/public/assets/images/products/<?= $product['image'] ?>" alt="" style="width: 40px; height: 40px; border-radius: 5px">
                                                        <div class="mx-3">
                                                            <a class="d-block" href="/product/detail/<?= $product['id'] ?>"><?= $product['title'] ?></a>
                                                            <div class="d-flex align-items-center"><span class="circle active" style="background-color: <?= $product['colorSelected'] ?>; width: 15px; height: 15px;"></span> - <span>Size: <?= $product['sizeSelected'] ?></span></div>
                                                            <div>
                                                                Sl: <?= $product['quantity'] ?>
                                                            </div>

                                                        </div>
                                                    </span>
                                                    <div>
                                                        <?php
                                                        if (!$isValid) {
                                                            echo '<span style="font-size: 11px; color : red">Số lượng trong kho: ' . $quantityLeft . ', vui lòng kiểm tra lại</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td><?= number_format($product['currentPrice']) ?>đ</td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>Vận chuyển:</td>
                                            <td>Miễn phí</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td >Tổng thành tiền:</td>
                                            <td class="total-price"><?= !empty($_SESSION['cart-total-amount']) ? number_format($_SESSION['cart-total-amount']) : 0 ?>Đ</td>
                                        </tr><!-- End .summary-total -->
                                        <tr>
                                            <td colspan="2" style="height: fit-content" class="price-to-words text-left">Bằng chữ:</td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                                <?php
                                if ($isValid) {
                                ?>
                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Đặt hàng</span>
                                        <span class="btn-hover-text">Đặt hàng</span>
                                    </button>
                                <?php } ?>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
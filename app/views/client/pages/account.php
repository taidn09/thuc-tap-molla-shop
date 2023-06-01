<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Cửa hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="true">Thông tin tài khoản</a>
                            </li>
                            <?php
                            if ($_SESSION['user']['socialLogin'] == 0) {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-password-link" data-toggle="tab" href="#tab-password" role="tab" aria-controls="tab-account" aria-selected="false">Thay đổi mật khẩu</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Danh sách đơn hàng</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/auth/logout">Đăng xuất</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="/account/update" method="POST" id="account-form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="w-100 d-flex justify-content-center mb-3">
                                            <div class="position-relative" style="width: 200px; height: 200px">
                                                <?php
                                                $userAvatar = '';
                                                if (!empty($_SESSION['user']['avatar'])) {
                                                    if (strstr($_SESSION['user']['avatar'], 'https') !== false) {
                                                        $userAvatar = $_SESSION['user']['avatar'];
                                                    } else {
                                                        $userAvatar = '/public/assets/images/user/' . $_SESSION['user']['avatar'];
                                                    }
                                                } else {
                                                    $userAvatar = '/public/assets/images/user.png';
                                                }
                                                ?>
                                                <img src="<?= $userAvatar ?>" data-old-image="<?=$userAvatar?>" class="w-100 h-100 rounded-circle" id="image">
                                                <label for="avatar" style="font-size: 40px; position: absolute; bottom: -20px; right: -10px; cursor: pointer"><i class="bi bi-camera-fill"></i></label>
                                                <div class="err-msg avatar-err-msg"></div>
                                            </div>
                                        </div>
                                        <input type="file" name="avatar" id="avatar" hidden>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="fname">Họ *</label>
                                            <input id="fname" name="fname" type="text" class="form-control" value="<?= !empty($_SESSION['user']['fname']) ? $_SESSION['user']['fname'] : '' ?>">
                                            <div class="ci-fname-err-msg err-msg"></div>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label for="lname">Tên *</label>
                                            <input id="lname" name="lname" type="text" class="form-control" value="<?= !empty($_SESSION['user']['lname']) ? $_SESSION['user']['lname'] : '' ?>">
                                            <div class=" ci-lname-err-msg err-msg">
                                            </div>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="email">Email *</label>
                                            <input readonly name="email" type="email" id="email" class="form-control" value="<?= !empty($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?>">
                                            <div class="ci-email-err-msg err-msg"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="phone">Số điện thoại *</label>
                                            <input type="phone" name="phone" id="phone" class="form-control" value="<?= !empty($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '' ?>">
                                            <div class="ci-phone-err-msg err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="province">Tỉnh/thành phố</label>
                                            <select class="form-control" name="province" id="province">
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="district">Quận/huyện</label>
                                            <select class="form-control" name="district" id="district">
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="ward">Phường/xã</label>
                                            <select class="form-control" name="ward" id="ward">
                                            </select>
                                        </div>
                                        <input autocomplete="off" type="hidden" name="province-is" id="province-is">
                                        <input autocomplete="off" type="hidden" name="district-is" id="district-is">
                                        <input autocomplete="off" type="hidden" name="ward-is" id="ward-is">
                                    </div>
                                    <label for="street">Tên đường - Số nhà</label>
                                    <input name="street" id="street" type="text" class="form-control" value="<?= !empty($_SESSION['user']['street']) ? $_SESSION['user']['street'] : '' ?>">
                                    <div class="ci-street-err-msg err-msg"></div>
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Lưu thay đổi</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                            <?php
                            if ($_SESSION['user']['socialLogin'] == 0) {
                            ?>
                                <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-password-link">
                                    <form action="/account/cpassword" method="POST" id="password-form">
                                        <label for="password">Mật khẩu hiện tại</label>
                                        <input name="password" id="password" type="password" class="form-control">
                                        <div class="ci-password-err-msg err-msg"></div>
                                        <label for="new-password">Mật khẩu mới</label>
                                        <input name="new-password" id="new-password" type="password" class="form-control">
                                        <div class="ci-new-password-err-msg err-msg"></div>
                                        <label for="cfpassword">Nhập lại mật khẩu mới</label>
                                        <input id="cfpassword" name="cfpassword" type="password" class="form-control mb-2">
                                        <div class="ci-cfpassword-err-msg err-msg"></div>
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Lưu thay đổi</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            <?php
                            }
                            ?>
                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <?php
                                if (empty($orders)) {
                                    $orders = [];
                                }
                                if (count($orders) > 0) {
                                ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="p-2">Mã đơn hàng</th>
                                                <th class="p-2">Ngày đặt</th>
                                                <th class="p-2">Tổng tiền</th>
                                                <th class="p-2">Trạng thái</th>
                                                <th class="p-2">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody class="order-list">
                                            <?php
                                            foreach ($orders as $order) {
                                            ?>
                                                <tr>
                                                    <td class="p-2">#
                                                        <?= $order['orderId'] ?>
                                                    </td>
                                                    <td class="p-2">
                                                        <?= $order['orderDate'] ?>
                                                    </td>
                                                    <td class="p-2">
                                                        <?= number_format($order['summary']) ?>đ
                                                    </td>
                                                    <td class="p-2">
                                                        <?php
                                                        $orderModel = new OrderModel();
                                                        $status = $orderModel->getStatusById($order['status']);
                                                        echo $status['status_text'];
                                                        ?>
                                                    </td>
                                                    <td class="p-2">
                                                        <?php
                                                        if ($order['status'] == 1) :
                                                        ?>
                                                            <button class="btn btn-primary" onclick="cancelOrder('<?= $order['orderId'] ?>')">Hủy đơn</button>
                                                        <?php endif;  ?>

                                                        <a href="/account/odt/<?= $order['orderId'] ?>" class="btn btn-custom btn-outline-primary">Chi tiết</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <p>Chưa có đơn hàng nào.</p>
                                <?php } ?>
                                <a href="/product" class="btn btn-outline-primary-2"><span>Mua sắm ngay</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
    const upload = document.querySelector('#avatar')
    upload.addEventListener('change', function(e) {
        var file = upload.files[0]
        var img = document.querySelector('#image')
        if (file != undefined) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(file)
            fileReader.onloadend = function(e) {
                img.src = e.target.result
            }
        } else {
            img.src = '/public/assets/images/' + img.getAttribute('data-old-image')
        }
    })
</script>
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
                                                <img src="<?= $userAvatar ?>" data-old-image="<?= $userAvatar ?>" class="w-100 h-100 rounded-circle" id="image">
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
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input name="password" id="password" type="password" class="form-control">
                                        </div>
                                        <div class="ci-password-err-msg err-msg"></div>
                                        <label for="new-password">Mật khẩu mới</label>
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input name="new-password" id="new-password" type="password" class="form-control">
                                        </div>
                                        <div class="ci-new-password-err-msg err-msg"></div>
                                        <label for="cfpassword">Nhập lại mật khẩu mới</label>
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input id="cfpassword" name="cfpassword" type="password" class="form-control mb-2">
                                        </div>
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
                        if (JSON.parse(response).uploadErr) {
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
</script>
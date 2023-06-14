<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/user" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Khách hàng</h5>

                <h3 class="text-center text-uppercase">Chỉnh sửa thông tin khách hàng</h3>
                <div class="row">

                    <div class="col-lg-12">
                        <form id="user-form" action="/admin/user/edit" method="post" class="mx-auto">
                            <input type="text" name="id" hidden value="<?= $user['userId'] ?>">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Họ *</label>
                                        <input name="fname" type="text" class="form-control" id="fname" placeholder="" spellcheck="false" autocomplete="off" value="<?= $user['fname'] ?>" />
                                        <div class="err-msg fname-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Tên *</label>
                                        <input name="lname" type="text" class="form-control" id="lname" placeholder="" spellcheck="false" autocomplete="off" value="<?= $user['lname'] ?>" />
                                        <div class="err-msg lname-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control" id="email" placeholder="" spellcheck="false" autocomplete="off" value="<?= $user['email'] ?>" />
                                        <div class="err-msg email-err-msg"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Số điện thoại</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="" spellcheck="false" autocomplete="off" value="<?= $user['phone'] ?>" />
                                        <div class="err-msg phone-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Mật khẩu</label>
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input name="password" type="password" class="form-control" id="password" placeholder="" spellcheck="false" autocomplete="off" value="" />
                                        </div>
                                        <div class="err-msg pass-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Nhập lại mật khẩu</label>
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input name="cfpass" type="text" class="form-control" id="cfpass" placeholder="" spellcheck="false" autocomplete="off" value="" />
                                        </div>
                                        <div class="err-msg cfpass-err-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mt-2">
                                        <label for="province">Tỉnh / thành phố</label>
                                        <select class="form-control" name="province" id="province">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mt-2">
                                        <label for="district">Quận / huyện</label>
                                        <select class="form-control" name="district" id="district">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mt-2">
                                        <label for="ward">Phường / xã</label>
                                        <select class="form-control" name="ward" id="ward">
                                        </select>
                                    </div>
                                </div>
                                <input autocomplete="off" type="hidden" name="province-is" id="province-is">
                                <input autocomplete="off" type="hidden" name="district-is" id="district-is">
                                <input autocomplete="off" type="hidden" name="ward-is" id="ward-is">
                            </div>
                            <div class="form-group mt-2">
                                <label for="street">Số nhà - Tên đường</label>
                                <input autocomplete="off" type="text" id="street" value="<?= $user['street'] ?>" class="form-control" name="street">
                                <div class="street-err-msg err-msg"></div>
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-custom btn-warning" style="min-width: 200px; padding: 6px 32px !important">
                                    Chỉnh sửa
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
<script>
    $('#user-form').on('submit', function(e) {
        e.preventDefault()
        let min = 2
        let max = 50
        let flag = true
        $(".err-msg").html('')
        const fname = $(this).find('#fname').val()
        const lname = $(this).find('#lname').val()
        const password = $(this).find('#password').val()
        const cfPass = $(this).find('#cfpass').val()
        if (validateIsEmpty(fname)) {
            $('.fname-err-msg').html('Chưa nhập họ...')
            flag = false
        } else if (!validateName(fname, min, max)) {
            $('.fname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
            flag = false
        }
        if (validateIsEmpty(lname)) {
            $('.lname-err-msg').html('Chưa nhập tên...')
            flag = false
        } else if (!validateName(lname, min, max)) {
            $('.lname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
            flag = false
        }
        if (!validateEmailAdress($(this).find('#email').val())) {
            $('.email-err-msg').html('Email không hợp lệ...')
            flag = false
        }
        if (!validatePhoneNumber($(this).find('#phone').val())) {
            $('.phone-err-msg').html('Số điện thoại không hợp lệ...')
            flag = false
        }
        if (validateIsEmpty($(this).find('#street').val())) {
            $('.street-err-msg').html('Chưa nhập tên đường và số nhà...')
            flag = false
        }
        if (!validateIsEmpty(password) || !validateIsEmpty(cfPass)) {
            if (password.length < 6) {
                $(".pass-err-msg").html('Mật khẩu tối thiểu 6 ký tự...')
                flag = false
            }
            if (cfPass != password) {
                $(".cfpass-err-msg").html('Nhập lại mật khẩu không khớp...')
                flag = false
            }
        }
        if (flag) {
            const formData = $(this).serialize()
            $.ajax({
                type: 'POST',
                url: '/admin/user/edit',
                data: formData,
                success: function(response) {
                    checkAdminRoleValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/admin/user'
                    } else {
                        Swal.fire({
                            ...successPopup,
                            icon: 'error',
                            title: `Email hoặc số điện thoại đã tồn tại`
                        })
                    }
                },
            });
        }
    })
</script>
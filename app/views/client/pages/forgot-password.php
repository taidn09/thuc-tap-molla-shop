<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
        <div class="container">
            <div class="form-box main-content">
                <h2 class="text-center">Quên mật khẩu</h2>
                <h6>Để lấy lại mật khẩu, hãy thực hiện theo các bước:</h6>
                <ul style="list-style: circle;">
                    <li>Nhập email bạn đã dùng để đăng ký tài khoản</li>
                    <li>Đợi hệ thống gửi mã xác nhận</li>
                    <li>Nhập mã xác nhận(Mã chỉ có hiệu lực trong 5 phút)</li>
                    <li>Điền mật khẩu mới cho tài khoản của bạn</li>
                </ul>
                <div class="inputs">
                    <div class="form-group">
                        <label for="email" class="form-label mt-2">Nhập email của bạn</label>
                        <input type="text" name="email" id="email" class="form-control">
                        <div class="err-msg email-err-msg"></div>
                        <button class="btn btn-outline-primary mt-2" onclick="handleSubmitEmail()">Gửi mã đến email</button>
                    </div>
                </div>
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
<script>
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
</script>
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
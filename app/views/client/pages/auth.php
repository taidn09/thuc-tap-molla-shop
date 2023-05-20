<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đăng nhập / Đăng ký</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
        <div class="container">
            <div class="form-box">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Đăng ký</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form class="login-form" method="post" action="/auth/login">
                                <div class="form-group">
                                    <label for="signin-email">Email *</label>
                                    <input type="text" class="form-control" id="signin-email" name="signin-email">
                                    <div class="login-email-err-msg err-msg"></div>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="signin-password">Mật khẩu *</label>
                                    <input type="password" class="form-control" id="signin-password" name="signin-password">
                                    <div class="login-pass-err-msg err-msg"></div>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Đăng nhập</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <a href="#" class="forgot-link">Quên mật khẩu?</a>
                                </div><!-- End .form-footer -->
                            </form>
                            <div class="form-choice">
                                <p class="text-center">Hoặc bạn có thể</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            Đăng nhập bằng Goggle
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login btn-f">
                                            <i class="icon-facebook-f"></i>
                                            Đăng nhập bằng Facebook
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .form-choice -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form class="register-form" method="post">
                                <div class="form-group">
                                    <label for="register-email">Email *</label>
                                    <input type="email" class="form-control" id="register-email" name="register-email">
                                    <div class="res-email-err-msg err-msg"></div>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-password">Mật khẩu *</label>
                                    <input type="password" class="form-control" id="register-password" name="register-password">
                                    <div class="res-pass-err-msg err-msg"></div>
                                </div><!-- End .form-group -->
                                <div class="form-group">
                                    <label for="register-cfpassword">Nhập lại mật khẩu *</label>
                                    <input type="password" class="form-control" id="register-cfpassword" name="register-cfpassword">
                                    <div class="res-cfpass-err-msg err-msg"></div>
                                </div><!-- End .form-group -->
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Đăng ký</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div><!-- End .form-footer -->
                            </form>
                            <div class="form-choice">
                                <p class="text-center">or bạn có thẻ thể</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            Đăng nhập bằng Goggle
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="#" class="btn btn-login  btn-f">
                                            <i class="icon-facebook-f"></i>
                                            Đăng nhập bằng Facebook
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .form-choice -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
</main><!-- End .main -->
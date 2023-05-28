<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false" onclick="console.log()">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Đăng ký</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <form class="login-form" method="post" action="/auth/login">
                                    <div class="form-group">
                                        <label for="signin-email-2">Email *</label>
                                        <input type="text" class="form-control" id="signin-email-2" name="signin-email">
                                        <div class="login-email-err-msg err-msg"></div>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="signin-password-2">Mật khẩu *</label>
                                        <input type="password" class="form-control" id="signin-password-2" name="signin-password">
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
                                    <p class="text-center">hoặc bạn có thể</p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Đăng nhập bằng Goggle
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                <form class="register-form" method="post">
                                    <div class="form-group">
                                        <label for="register-email-2">Email *</label>
                                        <input type="text" class="form-control" id="register-email-2" name="register-email">
                                        <div class="res-email-err-msg err-msg"></div>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password-2">Mật khẩu *</label>
                                        <input type="password" class="form-control" id="register-password-2" name="register-password">
                                        <div class="res-pass-err-msg err-msg"></div>
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-cfpassword-2">Nhập lại mật khẩu *</label>
                                        <input type="password" class="form-control" id="register-cfpassword-2" name="register-cfpassword">
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
                                    <p class="text-center">hoặc bạn có thể</p>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Đăng nhập bằng Goggle
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div>
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active"><a href="/contact">Liên hệ</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Địa chỉ</h3>

                        <address>1 New York Plaza, New York, <br>NY 10004, USA</address>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Hội thoại qua</h3>

                        <div><a href="mailto:#">info@Molla.com</a></div>
                        <div><a href="tel:#">+1 987-876-6543</a>, <a href="tel:#">+1 987-976-1234</a></div>
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Mạng xã hội</h3>

                        <div class="social-icons social-icons-color justify-content-center">
                            <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->

            <hr class="mt-3 mb-5 mt-md-1">
            <div class="touch-container row justify-content-center">
                <div class="col-md-9 col-lg-7">
                    <div class="text-center">
                        <h2 class="title mb-1">Giữ liện lạc</h2><!-- End .title mb-2 -->
                        <p class="lead text-primary">
                            Chúng tôi hợp tác với những thương hiệu và con người đầy tham vọng; chúng tôi muốn cùng nhau xây dựng một điều gì đó tuyệt vời.
                        </p><!-- End .lead text-primary -->
                    </div><!-- End .text-center -->

                    <form action="/contact/add" class="contact-form mb-2" id="contact-form">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Họ tên *" name="name" value="<?= !empty($_SESSION['user']['fname']) && !empty($_SESSION['user']['lname']) ? $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname'] : '' ?>">
                                <div class="ct-name-err-msg err-msg"></div>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cemail" class="sr-only">Name</label>
                                <input type="email" class="form-control" id="email" placeholder="Email *" name="email" value="<?= !empty($_SESSION['user']['email']) ? $_SESSION['user']['email'] : '' ?>">
                                <div class="ct-email-err-msg err-msg"></div>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Số điện thoại *" name="phone" value="<?= !empty($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '' ?>">
                                <div class="ct-phone-err-msg err-msg"></div>
                            </div><!-- End .col-sm-4 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="message" placeholder="Nội dung *" name="message"></textarea>
                        <div class="ct-mess-err-msg err-msg"></div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>Gửi</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div><!-- End .text-center -->
                    </form><!-- End .contact-form -->
                </div><!-- End .col-md-9 col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
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
                    checkUserValid(JSON.parse(response).status)
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
</script>
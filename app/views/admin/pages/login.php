<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="/admin/dashboard" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="" />
                                <span class="d-none d-lg-block">Molla Admin</span>
                            </a>
                        </div>
                        <!-- End Logo -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">
                                        Đăng nhập Admin
                                    </h5>
                                    <p class="text-center small">
                                        Nhập email và mật khẩu để đăng nhập
                                    </p>
                                </div>
                                <form class="row g-3" id="login-form" method="post" action="/admin/dashboard/login">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" autocomplete="off" spellcheck="false" />
                                        <div class="err-msg email-err-msg"></div>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <div class="password-field">
                                            <i class="bi bi-eye-slash-fill toggle-password"></i>
                                            <input type="password" name="password" class="form-control" id="password" autocomplete="off" spellcheck="false" />
                                            <div class="err-msg password-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">
                                            Đăng nhập
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script>
    $('#login-form').on('submit', function(e) {
        e.preventDefault()
        $('.err-msg').html('')
        let flag = true
        if ($('#email').val().trim() == '') {
            flag = false
            $('.email-err-msg').html('Vui lòng nhập email')
        }
        if ($('#password').val().trim() == '') {
            flag = false
            $('.password-err-msg').html('Vui lòng nhập mật khẩu')
        }
        if (flag) {
            const formData = $(this).serialize()
            $.ajax({
                type: 'POST',
                url: `/admin/dashboard/login`,
                data: formData,
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/admin/dashboard'
                    } else {
                        Swal.fire({
                            ...successPopup,
                            icon: 'error',
                            title: 'Email hoặc mật khẩu không chính xác!'
                        })
                    }
                },
            });
        }
    })
</script>
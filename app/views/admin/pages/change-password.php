<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Đổi mật khẩu</h5>

                <div class="row">
                    <div class="col-12">
                        <form id="changPass-form" action="/admin/dashboard/changePassword" method="post" class="mx-auto row">
                            <input type="text" name="id" id="id" hidden value="<?= $_SESSION['admin']['adminId'] ?>" readonly>
                            <div class="col-4">
                                <div class="form-group m-auto mt-2">
                                    <label for="password" class="form-label">Nhập mật khẩu cũ</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Nhập mật khẩu cũ..." spellcheck="false" autocomplete="off" value="" />
                                    <div class="err-msg password-err-msg"></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group m-auto mt-2">
                                    <label for="newpass" class="form-label">Nhập mật khẩu mới</label>
                                    <input name="newpass" type="password" class="form-control" id="newpass" placeholder="Nhập mật khẩu mới..." spellcheck="false" autocomplete="off" value="" />
                                    <div class="err-msg newpass-err-msg"></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group m-auto mt-2">
                                    <label for="cfpass" class="form-label">Nhập lại mật khẩu mới</label>
                                    <input name="cfpass" type="password" class="form-control" id="cfpass" placeholder="Nhập mật khẩu cũ..." spellcheck="false" autocomplete="off" value="" />
                                    <div class="err-msg cfpass-err-msg"></div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                    Hoàn tất
                                </button>
                                <a href="/admin/dashboard" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

<script>
    $('#changPass-form').on('submit', function(e) {
        e.preventDefault();
        let flag = true
        const password = $('#password').val().trim()
        const newpass = $('#newpass').val().trim()
        const cfpass = $('#cfpass').val().trim()
        const id = $('#id').val().trim()
        if (id == '') {
            flag = false
        }
        if (password == '') {
            flag = false
            $('.password-err-msg').html('Vui lòng nhập mật khẩu...')
        }
        if (newpass.length < 6) {
            flag = false
            $('.newpass-err-msg').html('Mật khẩu tối thiểu 6 ký tự...')
        }
        if (newpass != cfpass) {
            flag = false
            $('.cfpass-err-msg').html('Mật khẩu nhập lại không khớp...')
        }
        if (flag) {
            $.ajax({
                type: 'POST',
                url: '/admin/dashboard/changePassword',
                data: {
                    id,
                    password,
                    newpass
                },
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/admin/dashboard/'
                    } else {
                        $('.password-err-msg').html(JSON.parse(response).errMsg)
                    }
                },
            });
        }
    })
</script>
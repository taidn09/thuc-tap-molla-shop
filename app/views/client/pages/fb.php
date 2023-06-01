<div class="page-content">
    <?php
    if ($error) {
        echo $error;
    } else {
    ?>
        <div class="login-page">
            <div class="container">
                <div style="max-width: 100%; width: 600px" class="mx-auto mt-3">
                    <div class="row">
                        <div class="col-3">
                            <img src="<?= $pictureUrl ?>" alt="avatar" class="w-100 rounded-circle">
                        </div>
                        <div class="col-9">
                            <p>Họ và tên: <?= $firstName . ' ' . $lastName ?></p>
                        </div>
                    </div>
                </div>
                <div style="max-width: 100%; width: 600px" class="mx-auto mt-3">
                    <h5>Chúng tôi cần thêm thông tin cho việc xác minh:</h5>
                    <form action="/" id="fb-auth-form">
                        <div class="form-group w-100">
                            <label for="email" class="form-label">Nhập email (bắt buộc)</label>
                            <input type="text" id="email" name="email" class="form-control" autocomplete="off" spellcheck="false">
                            <div class="err-msg email-err-msg"></div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-outline-primary-2" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<main id="main" class="main">
    <!-- Recent Sales -->
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
                                        <input name="password" type="text" class="form-control" id="password" placeholder="" spellcheck="false" autocomplete="off" value="" />
                                        <div class="err-msg pass-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Nhập lại mật khẩu</label>
                                        <input name="cfpass" type="text" class="form-control" id="cfpass" placeholder="" spellcheck="false" autocomplete="off" value="" />
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
                                <a href="/admin/user" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Nhân viên</h5>

                <h3 class="text-center text-uppercase"> <?= (!empty($editMode)) ? 'Chỉnh sửa nhân viên' : 'Thêm nhân viên' ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        if (!empty($admin)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="admin-form" action="/admin/admin/edit" method="post" class="mx-auto" enctype="multipart/form-data">
                                    <input type="text" id="id" name="id" hidden value="<?= $admin['adminId'] ?>">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group m-auto mt-2">
                                                <label for="name" class="form-label">Tên nhân viên</label>
                                                <input name="name" type="text" class="form-control" id="name" placeholder="Nhập tên nhân viên..." spellcheck="false" autocomplete="off" value="<?= $admin['name'] ?>" />
                                                <div class="err-msg name-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group m-auto mt-2">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control" id="email" placeholder="Nhập email..." spellcheck="false" autocomplete="off" value="<?= $admin['email'] ?>" />
                                                <div class="err-msg email-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group m-auto mt-2">
                                                <label for="role" class="form-label">Chức vụ</label>
                                                <select name="role" class="form-control" id="role">
                                                    <option value="0" <?php if ($admin['role'] == 0) echo "selected" ?>>Nhân viên</option>
                                                    <option value="1" <?php if ($admin['role'] == 1) echo "selected" ?>>Quản lý</option>
                                                </select>
                                                <div class="err-msg role-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="password" class="form-label">Mật khẩu</label>
                                                <input name="password" type="text" class="form-control" id="password" placeholder="Nhập mật khẩu..." spellcheck="false" autocomplete="off" />
                                                <div class="err-msg password-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="cfpassword" class="form-label">Nhập lại mật khẩu</label>
                                                <input name="cfpassword" type="text" class="form-control" id="cfpassword" placeholder="Nhập lại mật khẩu..." spellcheck="false" autocomplete="off" />
                                                <div class="err-msg cfpassword-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="image" class="form-label">Hình ảnh</label>
                                                <input name="image" type="file" class="form-control" id="image"/>
                                                <div class="err-msg image-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <p>Xem trước hình ảnh</p>
                                            <img src="/public/assets/images/admin/<?= $admin['image'] ?>" alt="" style="width: 70%; max-width: 200px" class="img-preview">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Chỉnh sửa
                                        </button>
                                        <a href="/admin/admin" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-lg-12">
                            <form id="admin-form" action="/admin/admin/add" method="post" class="mx-auto" enctype="multipart/form-data">
                                <input type="text" name="id" hidden value="<?= $category['categoryId'] ?>">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="name" class="form-label">Tên nhân viên</label>
                                            <input name="name" type="text" class="form-control" id="name" placeholder="Nhập tên nhân viên..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg name-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="email" class="form-label">Email</label>
                                            <input name="email" type="text" class="form-control" id="email" placeholder="Nhập email..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg email-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="role" class="form-label">Chức vụ</label>
                                            <select name="role" class="form-control" id="role">
                                                <option value="0">Nhân viên</option>
                                                <option value="1">Quản lý</option>
                                            </select>
                                            <div class="err-msg role-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <input name="password" type="text" class="form-control" id="password" placeholder="Nhập mật khẩu..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg password-err-msg"></div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="cfpassword" class="form-label">Nhập lại mật khẩu</label>
                                            <input name="cfpassword" type="text" class="form-control" id="cfpassword" placeholder="Nhập lại mật khẩu..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg cfpassword-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="image" class="form-label">Hình ảnh</label>
                                            <input name="image" type="file" class="form-control" id="image" />
                                            <div class="err-msg image-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <p class="mt-2">Xem trước hình ảnh</p>
                                        <img src="" alt="" style="display: none; width: 70%; max-width: 200px" class="img-preview">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                        Thêm nhân viên
                                    </button>
                                    <a href="/admin/admin" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    const upload = document.querySelector('#image')
    upload.addEventListener('change', function(e) {
        var file = upload.files[0]
        var img = document.querySelector('.img-preview')
        var fileReader = new FileReader()
        fileReader.readAsDataURL(file)
        fileReader.onloadend = function(e) {
            img.src = e.target.result
            img.style.display = 'block'
        }
    })
</script>
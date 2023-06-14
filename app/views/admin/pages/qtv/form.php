<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/admin" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
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
                                                <?php 
                                                    foreach ($positions as $key => $position) {
                                                ?>
                                                    <option value="<?=$position['id']?>" <?php if($admin['role'] == $position['id']) echo "selected" ?>><?=$position['job_title']?></option>
                                                <?php }?>
                                                </select>
                                                <div class="err-msg role-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="password" class="form-label">Mật khẩu</label>
                                                <div class="password-field">
                                                    <i class="bi bi-eye-slash-fill toggle-password"></i>
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Nhập mật khẩu..." spellcheck="false" autocomplete="off" />
                                                </div>
                                                <div class="err-msg password-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="cfpassword" class="form-label">Nhập lại mật khẩu</label>
                                                <div class="password-field">
                                                    <i class="bi bi-eye-slash-fill toggle-password"></i>
                                                    <input name="cfpassword" type="password" class="form-control" id="cfpassword" placeholder="Nhập lại mật khẩu..." spellcheck="false" autocomplete="off" />
                                                </div>
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
                                            <p>Xem trước hình ảnh</p>
                                            <img src="/public/assets/images/admin/<?= $admin['image'] ?>" alt="" style="width: 70%; max-width: 200px" class="img-preview">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Chỉnh sửa
                                        </button>
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
                                                <?php 
                                                    foreach ($positions as $key => $position) {
                                                ?>
                                                    <option value="<?=$position['id']?>"><?=$position['job_title']?></option>
                                                <?php }?>
                                            </select>
                                            <div class="err-msg role-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <div class="password-field">
                                                <i class="bi bi-eye-slash-fill toggle-password"></i>
                                                <input name="password" type="password" class="form-control" id="password" placeholder="Nhập mật khẩu..." spellcheck="false" autocomplete="off" />
                                            </div>
                                            <div class="err-msg password-err-msg"></div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="cfpassword" class="form-label">Nhập lại mật khẩu</label>
                                            <div class="password-field">
                                                <i class="bi bi-eye-slash-fill toggle-password"></i>
                                                <input name="cfpassword" type="password" class="form-control" id="cfpassword" placeholder="Nhập lại mật khẩu..." spellcheck="false" autocomplete="off" />
                                            </div>
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

    $('#admin-form').on('submit', function(e) {
        e.preventDefault()
        const action = $(this).attr('action')
        let flag = true
        $('.err-msg').html('')
        const name = $(this).find('#name').val().trim()
        if (!name || name.length < 2 || name.length > 50) {
            $('.name-err-msg').html(`Nhập từ 2 đến 50 ký tự...`)
            flag = false
        }
        if (!validateEmailAdress($('#email').val())) {
            $('.email-err-msg').html(`Email không hợp lệ...`)
            flag = false
        }
        if ($('#password').val().trim() !== '' || $('#cfpassword').val().trim() !== '') {
            if ($('#password').val().trim().length < 6) {
                $('.password-err-msg').html(`Mật khẩu tối thiểu 6 ký tự...`)
                flag = false
            }
            if ($('#password').val().trim() != $('#cfpassword').val().trim()) {
                $('.cfpassword-err-msg').html(`Mật khẩu nhập lại không khớp...`)
                flag = false
            }
        }
        if ($('#image')[0].files.lenght <= 0) {
            $('.image-err-msg').html(`Vui lòng chọn hình ảnh...`)
            flag = false
        }
        if (flag) {
            var formData = new FormData();
            const action = $(this).attr('action')
            formData.append('name', name);
            formData.append('image', $('#image')[0].files[0]);
            formData.append('password', $('#password').val().trim());
            formData.append('email', $('#email').val().trim());
            formData.append('role', $('#role').val());
            if ($(this).find('#new-password').length != 0) {
                formData.append('newPassword', $('#new-password').val());
            }
            if (action.includes('edit')) {
                formData.append('id', $('#id').val());
            }
            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/admin/admin'
                    } else {
                        if (JSON.parse(response).uploadErr) {
                            $('.image-err-msg').html(JSON.parse(response).uploadErr)
                        }
                        if (JSON.parse(response).emailErr) {
                            $('.email-err-msg').html(JSON.parse(response).emailErr)
                        }
                    }
                },
            });
        }
    })
</script>
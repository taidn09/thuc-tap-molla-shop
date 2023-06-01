<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/blog" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Tin tức</h5>

                <h3 class="text-center text-uppercase"> <?= (!empty($editMode)) ? 'Chỉnh sửa tin tức' : 'Thêm tin tức' ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        if (!empty($blog)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="blog-form" action="/admin/blog/edit" method="post" class="mx-auto" enctype="multipart/form-data">
                                    <input type="text" name="id" id="id" hidden value="<?= $blog['blogId'] ?>">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="title" class="form-label">Tiêu đề</label>
                                                <input name="title" type="text" class="form-control" id="title" placeholder="Tiêu đề..." spellcheck="false" autocomplete="off" value="<?= $blog['title'] ?>" />
                                                <div class="err-msg title-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="author" class="form-label">Tác giả</label>
                                                <select name="author" class="form-select" id="select-box">
                                                    <?php
                                                    $adminModel = new AdminModel();
                                                    $authors = $adminModel->getAdminList(true);
                                                    foreach ($authors as $author) :
                                                    ?>
                                                        <option value="<?= $author['adminId'] ?>" <?= $author['adminId'] == $blog['authorId'] ? 'selected' : '' ?>><?= $author['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="err-msg author-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="thumbnail" class="form-label">Hình ảnh</label>
                                                <input name="thumbnail" type="file" class="form-control" id="thumbnail" />
                                                <div class="err-msg thumbnail-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <p class="mt-2">Xem trước hình ảnh</p>
                                            <img src="<?php echo _WEB_ROOT ?>/public/assets/images/blog/<?= $blog['thumbnail'] ?>" alt="" style="max-width: 200px" class="img-preview">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="createdAt" class="form-label">Ngày tạo</label>
                                                <input name="createdAt" type="date" class="form-control" id="createdAt" placeholder="Ngày tạo..." spellcheck="false" autocomplete="off" value="<?= $blog['createdAt'] ?>" />
                                                <div class="err-msg createdAt-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="shortDesc" class="form-label">Mô tả ngắn</label>
                                                <input name="shortDesc" type="text" class="form-control" id="shortDesc" placeholder="Mô tả ngắn..." spellcheck="false" autocomplete="off" value="<?= $blog['shortDesc'] ?>" />
                                                <div class="err-msg shortDesc-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- TinyMCE Editor -->
                                        <label for="content" class="mb-3">Nội dung</label>
                                        <textarea id="content" class="tinymce-editor" name="content"><?= $blog['content'] ?>
                                     </textarea><!-- End TinyMCE Editor -->
                                        <div class="err-msg content-err-msg"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Chỉnh sửa
                                        </button>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } else { ?>

                            <div class="col-lg-12">
                                <form id="blog-form" action="/admin/blog/add" method="post" class="mx-auto" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="title" class="form-label">Tiêu đề</label>
                                                <input name="title" type="text" class="form-control" id="title" placeholder="Tiêu đề..." spellcheck="false" autocomplete="off" />
                                                <div class="err-msg title-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="author" class="form-label">Tác giả</label>
                                                <select name="author" class="form-select" id="select-box">
                                                    <?php
                                                    $adminModel = new AdminModel();
                                                    $authors = $adminModel->getAdminList(true);
                                                    foreach ($authors as $author) :
                                                    ?>
                                                        <option value="<?= $author['adminId'] ?>"><?= $author['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="err-msg author-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="thumbnail" class="form-label">Hình ảnh</label>
                                                <input name="thumbnail" type="file" class="form-control" id="thumbnail" />
                                                <div class="err-msg thumbnail-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <p class="mt-2">Xem trước hình ảnh</p>
                                            <img src="" alt="" style="display: none; width: 70%; max-width: 200px" class="img-preview">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group m-auto mt-2">
                                                <label for="shortDesc" class="form-label">Mô tả ngắn</label>
                                                <input name="shortDesc" type="text" class="form-control" id="shortDesc" placeholder="Mô tả ngắn..." spellcheck="false" autocomplete="off" />
                                                <div class="err-msg shortDesc-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- TinyMCE Editor -->
                                        <label for="content" class="mt-2">Nội dung tin tức</label>
                                        <textarea id="content" class="tinymce-editor" name="content">
                                     </textarea><!-- End TinyMCE Editor -->
                                        <div class="err-msg content-err-msg"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Thêm mới
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                            </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    var selectBoxElement = document.querySelector('#select-box');
    dselect(selectBoxElement, {
        search: true,
        maxHeight: '200px'
    });
    const upload = document.querySelector('#thumbnail')
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
    $('#blog-form').on('submit', function(e) {
        e.preventDefault()
        const action = $(this).attr('action')
        let min = 2
        let max = 50
        let flag = true
        $(".err-msg").html('')
        const name = $(this).find('#title').val().trim()
        const createdAt = $(this).find('#createdAt').val()

        if (!name) {
            $('.title-err-msg').html(`Chưa nhập tiêu đề...`)
            flag = false
        }
        if (tinymce.activeEditor.getContent().trim() === '') {
            $('.content-err-msg').html(`Chưa nhập nội dung tin tức...`)
            flag = false
        }
        if ($('#shortDesc').val().trim() == '') {
            $('.shortDesc-err-msg').html(`Chưa nhập mô tả nhắn cho tin tức...`)
            flag = false
        }
        if (action.includes('edit')) {
            if (!createdAt) {
                $('.createAt-err-msg').html(`Chưa chọn ngày tạo tin tức...`)
                flag = false
            }
        }
        if (flag) {
            var formData = new FormData();
            formData.append('title', name);
            formData.append('thumbnail', $('#thumbnail')[0].files[0]);
            formData.append('author', $('#select-box').val());
            formData.append('content', tinymce.activeEditor.getContent());
            formData.append('shortDesc', $('#shortDesc').val().trim());
            if ($(this).find('#createdAt').length > 0) {
                formData.append('createdAt', $(this).find('#createdAt').val());
            }
            if ($(this).find('#id').length > 0) {
                formData.append('id', $(this).find('#id').val());
            }
            const action = $(this).attr('action')
            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        window.location = "/admin/blog"
                    } else {
                        $('.thumbnail-err-msg').html(JSON.parse(response).uploadErr)
                    }
                },
            });
        }
    })
</script>
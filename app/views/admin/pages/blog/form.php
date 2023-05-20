<main id="main" class="main">
    <!-- Recent Sales -->
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
                                                    $authors = $adminModel->getAdminList();
                                                    foreach ($authors as $author) :
                                                    ?>
                                                        <option value="<?= $author['adminId'] ?>" <?= $author['adminId'] == $blog['authorId'] ? 'selected' : '' ?>><?= $author['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="err-msg author-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                                <input name="thumbnail" type="file" class="form-control" id="thumbnail" />
                                                <div class="err-msg thumbnail-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <p>Xem trước hình ảnh</p>
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
                                        <label for="content">Content</label>
                                        <textarea id="content" class="tinymce-editor" name="content"><?= $blog['content'] ?>
                                     </textarea><!-- End TinyMCE Editor -->
                                        <div class="err-msg content-err-msg"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">
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
                                                    $authors = $adminModel->getAdminList();
                                                    foreach ($authors as $author) :
                                                    ?>
                                                        <option value="<?= $author['adminId'] ?>"><?= $author['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="err-msg author-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                                <input name="thumbnail" type="file" class="form-control" id="thumbnail" />
                                                <div class="err-msg thumbnail-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <p>Xem trước hình ảnh</p>
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
                                        <button class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">
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
</script>
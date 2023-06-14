<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/blogCategory" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Danh mục tin tức</h5>

                <h3 class="text-center text-uppercase"> <?= (!empty($editMode)) ? 'Chỉnh sửa danh mục' : 'Thêm danh mục' ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        if (!empty($category)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="category-form" action="/admin/blogCategory/edit" method="post" class="mx-auto">
                                    <input type="text" name="id" hidden value="<?= $category['id'] ?>">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Tên danh mục</label>
                                        <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tên danh mục..." spellcheck="false" autocomplete="off" value="<?= $category['title'] ?>" />
                                        <div class="err-msg title-err-msg"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Sửa danh mục
                                        </button>
                                    </div>
                                </form>
                            <?php } ?>
                        <?php } else { ?>

                            <div class="col-lg-12">
                                <form id="category-form" action="/admin/blogCategory/add" method="post" class="mx-auto">
                                    <?php
                                    ?>
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Tên danh mục</label>
                                        <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tên danh mục..." spellcheck="false" autocomplete="off" value="<?= !empty($_POST['title']) ? $_POST['title'] : '' ?>" />
                                        <div class="err-msg title-err-msg"></div>
                                    </div>
                                    <div class="form-group mt-2 m-auto">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Thêm danh mục
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
    // category
    $('#category-form').on('submit', function(e) {
        e.preventDefault()
        $(".title-err-msg").html('')
        if ($(this).find("#title").val() == '') {
            $(".title-err-msg").html('Chưa nhập tên danh mục...')
        } else {
            const formData = $(this).serialize()
            const action = $(this).attr('action')
            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                success: function(response) {
                    checkAdminRoleValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        window.location = "/admin/blogCategory"
                    } else {
                        $(".title-err-msg").html('Danh mục đã tồn tại...')
                    }
                },
            });
        }
    })
</script>
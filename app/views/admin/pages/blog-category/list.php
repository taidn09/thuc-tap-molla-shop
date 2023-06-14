<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('blogCategory-add')) :
        ?>
            <a href="/admin/blogCategory/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm danh mục mới</a>
        <?php endif; ?>

        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh mục tin tức</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th scope="col">Tiêu đề</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="blog-table-body">
                        <?php
                        $adminModel = new AdminModel();
                        foreach ($categories as $key => $category) {
                        ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $category['title'] ?></td>
                                <td>
                                    <?php
                                    if ($this->checkRole('blogCategory-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $category['id'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>

                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blogCategory-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/blogCategory/edit/<?= $category['id'] ?>" class="btn btn-warning btn-custom">
                                                Chỉnh sửa</a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

<script>
    $(document).on('click', '.delete-btn', function() {
        let btn = $(this)
        Swal.fire({
            ...confirmPopup,
            title: 'Xóa danh mục này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/blogCategory/delete`,
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(response) {
                        checkAdminRoleValid(JSON.parse(response).status)
                        if (response && JSON.parse(response).status == 1) {
                            $('.datatable').DataTable().row(btn.parents('tr')).remove().draw(false)
                        }
                    },
                });
            }
        })
    })
</script>
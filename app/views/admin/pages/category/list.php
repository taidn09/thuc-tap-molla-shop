<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('category-add')) :
        ?>
            <a href="/admin/category/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm danh mục mới</a>
        <?php endif; ?>

        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh mục sản phẩm</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="category-table-body">
                        <?php
                        foreach ($categoryList as $key=>$category) {
                        ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?= $category['title'] ?></td>
                                <td>
                                    <?php
                                    if ($this->checkRole('category-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $category['categoryId'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('category-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/category/edit/<?= $category['categoryId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
                                            </a>
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
                    url: `/admin/category/delete`,
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            $('.datatable').DataTable().row(btn.parents('tr')).remove().draw(false)
                        }
                    },
                });
            }
        })
    })
</script>
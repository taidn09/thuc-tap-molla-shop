<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <a href="/admin/position/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm chức vụ mới</a>
        <a href="/admin/position/authorize" class="text-white btn btn-custom btn-primary ms-auto d-inline-block py-2 px-5 mb-4">Phân quyền</a>
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách chức vụ</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th scope="col">Chức vụ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="admin-table-body">
                        <?php
                        foreach ($positions as $key => $position) {
                        ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $position['job_title'] ?></td>
                                <td>
                                    <div>
                                        <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $position['id'] ?>" href="javascript:void(0)">Xóa</a>
                                    </div>
                                    <div>
                                        <a href="/admin/position/edit/<?= $position['id'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
                                        </a>
                                    </div>
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
            title: 'Xóa chức vụ này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/position/delete`,
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
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <a href="/admin/admin/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm nhân viên</a>
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách nhân viên</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <td>Hình ảnh</td>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Email</th>
                            <th>Chức vụ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="admin-table-body">
                        <?php
                        $postionModel = new PositionModel();
                        foreach ($admins as $admin) {
                        ?>
                            <tr>
                                <td><img src="/public/assets/images/admin/<?= $admin['image'] ?>" alt="" style="width: 50px">
                                </td>
                                <td><?= $admin['name'] ?></td>
                                <td><?= $admin['email'] ?></td>
                                <td><?=$postionModel->getById($admin['role'])['job_title']?></td>
                                <td>
                                    <div>

                                        <a class="btn btn-danger btn-custom delete-btn" data-id="<?=$admin['adminId']?>" href="javascript:void(0)">Xóa</a>
                                    </div>
                                    <div>
                                        <a href="/admin/admin/edit/<?= $admin['adminId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
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
            title: 'Xóa nhân viên này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/admin/delete`,
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
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách khách hàng</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="user-table-body">
                        <?php
                        foreach ($userList as $key=>$user) {
                        ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><a href="/admin/user/detail/<?= $user['userId'] ?>"><?= $user['fname'] . ' ' . $user['lname'] ?></a></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['phone'] ?></td>
                                <td style="max-width: 320px !important">
                                    <p style=" word-wrap: break-word;
                                            white-space: normal;
                                            overflow: hidden;
                                            display: -webkit-box;
                                            text-overflow: ellipsis;
                                            -webkit-box-orient: vertical;
                                            -webkit-line-clamp: 2;">
                                        <?= $user['street'] . '-' . $user['ward'] . '-' . $user['district'] . '-' . $user['province'] ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    if ($this->checkRole('user-detail')) :
                                    ?>
                                        <div>

                                            <a class="btn btn-success btn-custom" href="/admin/user/detail/<?= $user['userId'] ?>">Thông tin</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('user-delete')) :
                                    ?>
                                        <div> <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $user['userId'] ?>" href="javascript:void(0)">Xóa</a></div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('user-edit')) :
                                    ?>
                                        <a href="/admin/user/edit/<?= $user['userId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
                                        </a>
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
            title: 'Xóa khách hàng này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/user/delete`,
                    data: {
                        id: btn.data('id')
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
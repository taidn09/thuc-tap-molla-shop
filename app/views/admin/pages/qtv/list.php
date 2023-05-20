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
                        foreach ($admins as $admin) {
                        ?>
                            <tr>
                                <td><img src="/public/assets/images/admin/<?= $admin['image'] ?>" alt="" style="width: 50px">
                                </td>
                                <td><?= $admin['name'] ?></td>
                                <td><?= $admin['email'] ?></td>
                                <td><?= $admin['role'] == 0 ? 'Nhân viên' : 'Quản lý' ?></td>
                                <td>
                                    <a href="/admin/admin/authorize/<?=$admin['adminId']?>" class="btn btn-custom btn-primary"><i class="bi bi-gear-wide"></i></a>
                                    <a class="btn btn-danger btn-custom" onclick="deleteAdmin('<?= $admin['adminId'] ?>');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <a href="/admin/admin/edit/<?= $admin['adminId'] ?>" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
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

</script>
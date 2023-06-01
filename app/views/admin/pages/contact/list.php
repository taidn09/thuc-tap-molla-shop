<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách liên hệ</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Người gửi</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Ngày gửi</th>
                            <th scope="col">Message</th>
                            <th scope="col">Đã phản hồi</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="contact-table-body">
                        <?php
                        foreach ($contacts as $key=>$contact) {
                        ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?= $contact['name'] ?></td>
                                <td><?= $contact['email'] ?></td>
                                <td><?= $contact['phone'] ?></td>
                                <td><?= $contact['createdAt'] ?></td>
                                <td style="max-width: 250px;">
                                    <p style=" word-wrap: break-word;
                                    white-space: normal;
                                    overflow: hidden;
                                    display: -webkit-box;
                                    text-overflow: ellipsis;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 2;">
                                        <?= $contact['message'] ?>
                                    </p>
                                </td>
                                <td>
                                    <?= $contact['reply'] ? '<i class="bi bi-check-circle-fill text-success"></i>' : '' ?>
                                </td>
                                <td>
                                    <?php
                                    if ($this->checkRole('contact-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $contact['id'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('contact-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/contact/reply/<?= $contact['id'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa
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
            title: 'Xóa liên hệ này này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/contact/delete`,
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
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách đơn hàng</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Mã đơn hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Người nhận</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tổng tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="order-table-body">
                        <?php
                        foreach ($orders as $key=>$order) {
                        ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><a href="/admin/order/detail/<?= $order['orderId'] ?>"><?= $order['orderId'] ?></a></td>
                                <td><?= $order['orderDate'] ?></td>
                                <td><?= $order['receiver'] ?></td>
                                <td><?= $order['phone'] ?></td>
                                <td style="max-width: 250px;">
                                    <p style=" word-wrap: break-word;
    white-space: normal;
    overflow: hidden;
    display: -webkit-box;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;">
                                        <?= $order['street'] . '-' . $order['ward'] . '-' . $order['district'] . '-' . $order['province'] ?>
                                    </p>
                                </td>
                                <td><?= number_format($order['summary']) ?>đ</td>
                                <td>
                                    <?php
                                    if ($this->checkRole('order-detail')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-success btn-custom" href="/admin/order/detail/<?= $order['orderId'] ?>">Chi tiết</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $order['orderId'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/order/edit/<?= $order['orderId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
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
            title: 'Xóa đơn hàng này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/order/delete`,
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
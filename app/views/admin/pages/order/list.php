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
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Người nhận</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Tổng tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="order-table-body">
                        <?php
                        foreach ($orders as $order) {
                        ?>
                            <tr>
                                <td><a href="/admin/order/detail/<?= $order['orderId'] ?>"><?= $order['orderId'] ?></a></td>
                                <td><?= $order['orderDate'] ?></td>
                                <td><?= $order['receiver'] ?></td>
                                <td><?= $order['email'] ?></td>
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
                                <td><?= $order['summary'] ?>đ</td>
                                <td>
                                    <?php
                                    if ($this->checkRole('order-detail')) :
                                    ?>
                                        <a class="btn btn-success btn-custom" href="/admin/order/detail/<?= $order['orderId'] ?>"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteOrder('<?= $order['orderId'] ?>');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-edit')) :
                                    ?>
                                        <a href="/admin/order/edit/<?= $order['orderId'] ?>" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
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

</script>
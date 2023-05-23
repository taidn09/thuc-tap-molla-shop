<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="">
                    <h5 class="card-title text-uppercase">Thông tin đơn hàng</h5>
                    <div class="b-block">
                        <ul>
                            <li>Mã đơn hàng: <?= $order['orderId'] ?></li>
                            <li>Người nhận: <?= $order['receiver'] ?></li>
                            <li>Email: <?= $order['email'] ?></li>
                            <li>Phone: <?= $order['phone']  ?></li>
                            <li>Địa chỉ: <?= $order['street'] . '-' . $order['ward'] . '-' . $order['district'] . '-' . $order['province'] ?></li>
                            <li><b>Tổng tiền:</b> $<?= $order['summary'] ?></li>
                        </ul>

                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        <?php
                        $productModel = new ProductModel();
                        foreach ($orderDetail as $item) {
                            $product = $productModel->getProductById($item['productId']);
                            $option = $productModel->getOptionById($item['optionId']);
                        ?>
                            <tr>
                                <td><?= $product['title'] ?></td>
                                <td><?=$option['color'] ?></td>
                                <td><?=$option['size'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$<?= $item['price'] ?></td>
                                <td>$<?= $item['total'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <a href="/admin/order" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
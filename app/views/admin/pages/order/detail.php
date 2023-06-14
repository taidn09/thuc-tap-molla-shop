<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/order" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
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
                            <th>Trạng thái</th>
                        </tr>
                        <?php
                        $productModel = new ProductModel();
                        foreach ($orderDetail as $item) {
                            $product = $productModel->getProductById($item['productId'], true);
                            $option = $productModel->getOptionById($item['optionId']);
                        ?>
                            <tr>
                                <td><?= $product['title'] ?></td>
                                <td><?= $option['color'] ?></td>
                                <td><?= $option['size'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$<?= number_format($item['price']) ?></td>
                                <td>$<?= number_format($item['total']) ?></td>
                                <?php if ($item['returned'] == 0) : ?>
                                    <td>Bình thường</td>
                                <?php else : ?>
                                    <td><button data-bs-toggle="modal" data-bs-target="#modal-<?=$item['optionId']?>" class="btn btn-custom btn-primary">Trả hàng</button></td>
                                    <div class="modal fade" id="modal-<?=$item['optionId']?>" tabindex="-1" aria-labelledby="example-label-<?=$item['optionId']?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="example-label-<?=$item['optionId']?>">Thông tin trả hàng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>
                                                        <b>Lý do:</b>
                                                        <p><?=$item['return_reason']?></p>
                                                    </div>
                                                    <div>
                                                        <b>Hình ảnh:</b>
                                                        <p><img src="/public/assets/images/returns/<?=$item['return_image']?>" alt="" style="width: 200px;"></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-custom btn-danger" data-bs-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
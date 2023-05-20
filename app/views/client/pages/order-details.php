<main class="main">
    <div class="page-content">
        <div class="container">
            <h3 class="mt-3">Chi tiết đơn hàng:</h3>
            <div class="row">
                <div class="col-12">
                    <h5>Thông tin giao hàng</h5>
                    <table class="table table-bordered">
                        <tr>
                            <td class="p-2">Ngày đặt:</td>
                            <td class="p-2"><?= $order['orderDate'] ?></td>
                        </tr>
                        <tr>
                            <td class="p-2">Người nhận:</td>
                            <td class="p-2"><?= $order['receiver'] ?></td>
                        </tr>
                        <tr>
                            <td class="p-2">Email:</td>
                            <td class="p-2"><?= $order['email'] ?></td>
                        </tr>
                        <tr>
                            <td class="p-2">Số điện thoại:</td>
                            <td class="p-2"><?= $order['phone'] ?></td>
                        </tr>
                        <tr>
                            <td class="p-2">Địa chỉ:</td>
                            <td class="p-2"><?= $order['street'] . ' - ' . $order['ward'] . ' - ' . $order['district'] . ' - ' . $order['province'] ?></td>
                        </tr>
                        <tr>
                            <td class="p-2">Tổng thành tiền:</td>
                            <td class="p-2"><?= $order['summary'] ?>đ</td>
                        </tr>
                    </table>
                </div>
                <div class="col-12">
                    <h5>Danh sách sản phẩm</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th class="p-2">Tên sản phẩm</th>
                            <th class="p-2">Màu sắc</th>
                            <th class="p-2">Size</th>
                            <th class="p-2">Số lượng</th>
                            <th class="p-2">Giá tiền</th>
                            <th class="p-2">Thành tiền</th>
                        </tr>

                        <?php
                        $productModel = new ProductModel();
                        foreach ($detail as $item) {
                            $product = $productModel->getProductById($item['productId']);
                            $option = $productModel->getOptionById($item['optionId']);
                        ?>
                            <tr>
                                <td class="p-2"><?= $product['title'] ?></td>
                                <td class="p-2"><?= $option['color'] ?></td>
                                <td class="p-2"><?= $option['size'] ?></td>
                                <td class="p-2"><?= $item['quantity'] ?></td>
                                <td class="p-2"><?= $item['price'] ?>đ</td>
                                <td class="p-2"><?= $item['total'] ?>đ</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>
            </div>
            <div class="text-center">
                <a href="/account" class="btn btn-outline-primary">Trở về</a>
            </div>
        </div>
    </div><!-- End .page-content -->
</main><!-- End .main -->
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
                    <p>Bạn có thể trả hàng và được hoàn tiền 100% trong vòng 3 ngày nếu như hàng bị lỗi...</p>

                    <table class="table table-bordered">
                        <tr>
                            <th class="p-2">Tên sản phẩm</th>
                            <th class="p-2">Màu sắc</th>
                            <th class="p-2">Size</th>
                            <th class="p-2">Số lượng</th>
                            <th class="p-2">Giá tiền</th>
                            <th class="p-2">Thành tiền</th>
                            <th class="p-2">Thao tác</th>
                        </tr>

                        <?php

                        $productModel = new ProductModel();
                        foreach ($detail as $item) {
                            $product = $productModel->getProductById($item['productId'], true);
                            $option = $productModel->getOptionById($item['optionId']);
                        ?>
                            <tr>
                                <td class="p-2"><?= $product['title'] ?></td>
                                <td class="p-2"><?= $option['color'] ?></td>
                                <td class="p-2"><?= $option['size'] ?></td>
                                <td class="p-2"><?= $item['quantity'] ?></td>
                                <td class="p-2"><?= number_format($item['price']) ?>đ</td>
                                <td class="p-2"><?= number_format($item['total']) ?>đ</td>
                                <td class="p-2">
                                    <?php
                                    $startDate = new DateTime($order['orderDate']);
                                    $today = new DateTime();
                                    $interval = $today->diff($startDate);
                                    $numberOfDays = $interval->format('%a');
                                    if ($numberOfDays <= 3 && $item['returned'] == 0) :
                                    ?>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-<?= $item['optionId'] ?>">Trả hàng</button>
                                        <div class="modal fade" id="modal-<?= $item['optionId'] ?>" tabindex="-1" aria-labelledby="model-label-<?= $item['optionId'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form action="/" method="POST" class="modal-content return-form" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="model-label-<?= $item['optionId'] ?>">Trả hàng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mx-4">
                                                            <input type="hidden" name="orderId" readonly value="<?= $item['orderId'] ?>">
                                                            <input type="hidden" name="optionId" readonly value="<?= $item['optionId'] ?>">
                                                            <div class="form-group">
                                                                <label>Lý do trả hàng</label>
                                                                <textarea id="reason-<?= $order['orderId'] ?>" name="reason" class="form-control" placeholder="Lí do trả hàng (cụ thể)..."></textarea>
                                                                <div class="err-msg reason-err-msg"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Hình ảnh chứng minh(rõ nét)</label>
                                                                <input type="file" name="image" id="image-<?= $order['orderId'] ?>" class="form-control">
                                                                <div class="err-msg image-err-msg"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($item['returned'] == 1) {
                                        echo "Đã trả hàng";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>
            </div>
            <div class="text-center">
                <a href="/account" class="btn btn-outline-primary">Trở về</a>
                <?php if ($order['rated'] != 1) : ?>
                    <a href="/account/review/<?= $order['orderId'] ?>" class="btn btn-outline-primary">Đánh giá</a>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- End .page-content -->
</main><!-- End .main -->
<script>
    // trả hàng
    $('.return-form').on('submit', handleReturn)

    function handleReturn(e) {
        e.preventDefault()
        let flag = true
        const _this = $(this)
        const td = _this.parents('td')
        const reason = $(this).find('textarea[name="reason"]');
        const images = $(this).find('input[type="file"]');
        if (reason.val().trim() == '') {
            flag = false
            reason.siblings('.err-msg').html("Bạn chưa nhập lý do trả hàng...")
        }
        if (images[0].files.length <= 0) {
            flag = false
            images.siblings('.err-msg').html("Bạn chưa cung cấp hình ảnh...")
        }
        const formData = new FormData()
        formData.append('orderId', _this.find('input[name="orderId"]').val());
        formData.append('optionId', _this.find('input[name="optionId"]').val());
        formData.append('image', _this.find('input[name="image"]')[0].files[0]);
        formData.append('reason', _this.find('textarea[name="reason"]').val());
        if (flag) {
            $.ajax({
                type: 'POST',
                url: '/account/returns',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    checkUserValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        Swal.fire({
                            ...successPopup,
                            timer: false,
                            showConfirmButton: true,
                            title: 'Yêu cầu đã được xử lý...',
                            willClose: () => {
                                location.reload()
                            }
                        }).then(result => {
                            if (result.isConfirmed) {
                                location.reload()
                            }
                        })
                    }
                },
            });
        }
    }
</script>
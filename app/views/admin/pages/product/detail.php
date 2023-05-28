<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body pt-4">
                <div style="max-width: 100%;">
                    <h3>
                        Thông tin sản phẩm:
                    </h3>
                    <ul>
                        <li>Tên sản phẩm: <b><?= $product['title'] ?></b></li>
                        <li>Giá gốc: <?= $product['originalPrice'] ?>đ</li>
                        <li>Giảm giá: <?= $product['salePercent'] ?>%</li>
                        <li>Giá sau giảm: <?= $product['currentPrice'] ?>đ</li>
                        <li>Số sao đánh giá: <?= $product['rating'] ?></li>
                        <li>Số lượt đánh giá: <?= $product['reviewCount'] ?></li>
                        <li>Số lượt bán: <?= $product['sold'] ?></li>
                        <li>Thuộc danh mục: <?= $category['title'] ?></li>
                        <li>Mô tả: <?=$product['description']?></li>
                    </ul>
                    <h3>Danh mục hình ảnh</h3>
                    <div>
                        <?php
                        if ($this->checkRole('product-uploadProductImages')) :
                        ?>
                            <form id="images-form" action="/admin/product/uploadProductImages" class="form-group my-2" enctype="multipart/form-data">
                                <input type="file" name="images[]" id="images" multiple class="form-control">
                                <input type="hidden" name="productId" id="productId" value="<?= $product['productId'] ?>">
                                <div class="err-msg file-err-msg"></div>
                                <button class="btn btn-custom btn-primary mt-1" type="submit" style="min-width: 200px; padding: 6px 32px !important">Cập nhật danh sách hình ảnh</button>
                            </form>
                        <?php endif; ?>
                        <div class="imgs">
                            <?php
                            foreach ($imagesGallery as $image) {
                            ?>
                                <span style="width: 20%; min-width: 200px" class="position-relative d-inline-block">
                                    <?php
                                    if ($this->checkRole('product-deleteImage')) :
                                    ?>
                                        <button onclick="deleteImage('<?= $image['imgId'] ?>', '<?= $product['productId'] ?>')" class="btn btn-custom btn-danger position-absolute" style="right: 0;"><i class="bi bi-x"></i></button>
                                    <?php endif; ?>
                                    <img src="/public/assets/images/products/<?= $image['image'] ?>" class="w-100">
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class=text-end>
                    <?php
                    if ($this->checkRole('product-addOption')) :
                    ?>
                    <?php endif; ?>
                    <a href="/admin/product/addOption/<?= $product['productId'] ?>" class="btn btn-success btn-custom" style="min-width: 200px; padding: 6px 32px !important">Thêm thuộc tính <i class="bi bi-plus-circle"></i></i>
                    </a>
                </div>
                <?php
                if (!empty($productOptions)) {
                ?>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Màu sắc</th>
                                <th>Kích cỡ</th>
                                <th>Số lượng còn lại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="options">

                            <?php

                            foreach ($productOptions as $option) {
                            ?>
                                <tr>
                                    <td class="d-flex gap-2"><span class="d-block" style="width: 30px; height: 30px; background-color: <?= $option['color'] ?>; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 0 3px #000"></span><?= $option['color'] ?></td>
                                    <td><?= $option['size'] ?></td>
                                    <td><?= $option['quantity'] ?></td>
                                    <td>
                                        <?php
                                        if ($this->checkRole('product-deleteOption')) :
                                        ?>
                                            <a class="btn btn-danger btn-custom" onclick="deleteOption('<?= $option['optionId'] ?>','<?= $product['productId'] ?>');" href="javascript:void(0)">Xóa thuộc tính<i class="bi bi-trash"></i></a>
                                        <?php endif; ?>
                                        <?php
                                        if ($this->checkRole('product-editOption')) :
                                        ?>
                                            <a href="/admin/product/editOption/<?= $product['productId'] ?>/<?= $option['optionId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa thuộc tính<i class="bi bi-pen"></i>
                                            </a>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php }else{
                ?>
                    <h2 class="text-center">Sản phẩm này chưa có thuộc tính</h2>
                <?php }?>
                <a href="/admin/product" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('product-add')) :
        ?>
            <a href="/admin/product/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm sản phẩm mới</a>
        <?php endif; ?>
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách sản phẩm</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th>Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá gốc</th>
                            <th scope="col">Phần trăm giảm</th>
                            <th scope="col">Giá sau giảm</th>
                            <th scope="col">Số lượt bán</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="product-table-body">
                        <?php
                        foreach ($products as $product) {
                            $img = $this->model->getProductImage($product['productId'], 1);
                        ?>
                            <tr>
                                <td><img src="<?php echo _WEB_ROOT ?>/public/assets/images/products/<?php if (!empty($img)) echo $img[0]['image']  ?>" style="width: 50px" alt=""></td>
                                <td style="max-width: 200px;">
                                    <p style=" word-wrap: break-word;
                                white-space: normal;
                                overflow: hidden;
                                display: -webkit-box;
                                text-overflow: ellipsis;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 2; "><?= $product['title'] ?></p>
                                </td>
                                <td><?= number_format($product['originalPrice']) ?>đ</td>
                                <td><?= $product['salePercent'] ?></td>
                                <td><?= number_format($product['currentPrice']) ?>đ</td>
                                <td><?= $product['sold'] ?></td>
                                <td>
                                    <?php
                                    if ($this->checkRole('product-toggle')) :
                                    ?>
                                        <a class="btn btn-primary btn-custom" onclick="toggleShowHideProduct('<?= $product['productId'] ?>','<?= $product['isShown'] ?>');" href="javascript:void(0)"><i class="bi <?= $product['isShown'] == 1 ? 'bi-eye-slash' : 'bi-eye' ?>"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-detail')) :
                                    ?>
                                        <a class="btn btn-success btn-custom" href="/admin/product/detail/<?= $product['productId'] ?>"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteProduct('<?= $product['productId'] ?>');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-edit')) :
                                    ?>
                                        <a href="/admin/product/edit/<?= $product['productId'] ?>" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
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
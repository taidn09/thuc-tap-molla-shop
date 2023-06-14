<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/product" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
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
                        <li>Số lượt xem: <?= $product['views'] ?></li>
                        <li>Thuộc danh mục: <?= $category['title'] ?></li>
                        <li>Mô tả: <?= $product['description'] ?></li>
                    </ul>
                    <?php if ($this->checkRole('product-accessImages')) : ?>
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
                                            <button onclick="deleteImage('<?= $image['imgId'] ?>', '<?= $product['productId'] ?>')" class="btn btn-custom btn-danger position-absolute" style="right: 0;">Xóa hình ảnh</button>
                                        <?php endif; ?>
                                        <img src="/public/assets/images/products/<?= $image['image'] ?>" class="w-100">
                                    </span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                  <?php 
                    if($this->checkRole('product-accessOptions')):
                  ?>
                                  <div class=text-end>
                    <?php
                    if ($this->checkRole('product-addOption')) :
                    ?>
                        <a href="/admin/product/addOption/<?= $product['productId'] ?>" class="btn btn-success btn-custom mb-5" style="min-width: 200px; padding: 6px 32px !important">Thêm thuộc tính <i class="bi bi-plus-circle"></i></i>
                        </a>
                    <?php endif; ?>
                </div>
                <?php
                if (!empty($productOptions)) {
                ?>
                    <table class="ui celled table datatable child">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Màu sắc</th>
                                <th>Kích cỡ</th>
                                <th>Số lượng còn lại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="options">
                            <?php
                            foreach ($productOptions as $key => $option) {
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2 text-uppercase"><span style="display: block ;width: 20px; height: 20px; background-color: <?= $option['color'] ?>; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 0 3px #000"></span> <?= $option['color'] ?></div>
                                    </td>
                                    <td><?= $option['size'] ?></td>
                                    <td><?=number_format( $option['quantity']) ?></td>
                                    <td>
                                        <?php
                                        if ($this->checkRole('product-deleteOption')) :
                                        ?>
                                            <div>
                                                <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $option['optionId'] ?>" href="javascript:void(0)">Xóa</a>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if ($this->checkRole('product-editOption')) :
                                        ?>
                                            <div>
                                                <a href="/admin/product/editOption/<?= $product['productId'] ?>/<?= $option['optionId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else {
                ?>
                    <h2 class="text-center">Sản phẩm này chưa có thuộc tính</h2>
                <?php } ?>
            </div>
                  <?php endif;?>    
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

<script>
    function updateImageList(response) {
        const {
            images,
            allowDelete
        } = JSON.parse(response)
        let imgsHTML = ''
        for (const key in images) {
            const {
                imgId,
                productId,
                image
            } = images[key]
            let _btn = ''
            if(allowDelete){
                _btn = `<button onclick="deleteImage('${imgId}', '${productId}')" class="btn btn-custom btn-danger position-absolute" style="right: 0;">Xóa hình ảnh</button>`
            }
            imgsHTML += `
                <span style="width: 20%; min-width: 200px" class="position-relative d-inline-block">
                    ${_btn}
                                    
                                    <img src="/public/assets/images/products/${image}" class="w-100">
                                </span>
                    `
        }
        $('.imgs').html(imgsHTML)
    }
    $('#images-form').on('submit', function(e) {
        e.preventDefault()
        if ($('#images')[0].files.length > 0) {
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '/admin/product/uploadProductImages',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    checkAdminRoleValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        updateImageList(response)
                        $('#images').val('')
                    } else {
                        $('.file-err-msg').html(JSON.parse(response).uploadErr)
                    }
                },
            });
        } else {
            $('.file-err-msg').html('Vui lòng chọn hình ảnh')
        }
    })

    function deleteImage(id, productId) {
        if (id && productId) {
            Swal.fire({
                ...confirmPopup,
                title: 'Xác nhận xóa ảnh ?',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: `/admin/product/deleteImage`,
                        data: {
                            id,
                            productId
                        },
                        success: function(response) {
                            checkAdminRoleValid(JSON.parse(response).status)
                            if (response && JSON.parse(response).status == 1) {
                                updateImageList(response)
                            }
                        },
                    });
                }
            })
        }
    }
    $(document).on('click', '.delete-btn', function() {
        let btn = $(this)
        Swal.fire({
            ...confirmPopup,
            title: 'Xóa sản phẩm này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/product/deleteOption`,
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
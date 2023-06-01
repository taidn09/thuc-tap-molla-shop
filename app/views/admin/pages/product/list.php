<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('product-add')) :
        ?>
            <a href="/admin/product/add" class="text-white btn btn-custom btn-success d-inline-block py-2 px-5 mb-4">Thêm sản phẩm mới</a>
        <?php endif; ?>
        <a href="javascript:void(0)" onclick="exportExcel()" class="text-white btn btn-custom btn-primary ms-auto d-inline-block py-2 px-5 mb-4">Xuất dữ liệu</a>
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Danh sách sản phẩm</h5>
                <div class="d-flex justify-content-around mb-3">
                    <div class="form-group">
                        <label for="import">Nhập liệu từ file</label>
                        <div class="d-flex">
                            <input type="file" name="import" id="import" class="form-control" placeholder="Chọn file">
                            <button class="btn btn-custom btn-primary" style="width: 200px" onclick="importProducts()">Nhập file</button>
                        </div>
                        <div class="err-msg import-err-msg"></div>
                    </div>
                    <div class=" form-group">
                        <label for="catesFilter">Phân loại theo danh mục:</label>
                        <select name="catesFilter[]" id="catesFilter" class="form-select" onchange="filterProduct(this.value)">
                            <option value="all">Tất cả</option>
                            <?php
                            foreach ($categories as $key => $category) {
                            ?>
                                <option value="<?= $category['categoryId'] ?>"><?= $category['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="main-content">
                    <table class="ui celled table datatable child">
                        <thead>
                            <tr>
                                <th>#</th>
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
                            foreach ($products as $key => $product) {
                                $img = $this->model->getProductImage($product['productId'], 1);
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
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
                                            <div>
                                                <a class="btn btn-primary btn-custom toggle-btn" data-id="<?= $product['productId'] ?>" data-show="<?= $product['isShown'] ?>" href="javascript:void(0)"><?= $product['isShown'] == 1 ? 'Ẩn' : 'Hiện' ?></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if ($this->checkRole('product-detail')) :
                                        ?>
                                            <div> <a class="btn btn-success btn-custom" href="/admin/product/detail/<?= $product['productId'] ?>">Chi tiết</a></div>
                                        <?php endif; ?>
                                        <?php
                                        if ($this->checkRole('product-delete')) :
                                        ?>
                                            <div>
                                                <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $product['productId'] ?>" href="javascript:void(0)">Xóa</a>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        if ($this->checkRole('product-edit')) :
                                        ?>
                                            <div>
                                                <a href="/admin/product/edit/<?= $product['productId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa
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
    </div>
    <!-- End Recent Sales -->
</main>

<script>
    function updateProductsTable(response) {
        const {
            products
        } = JSON.parse(response)
        let productsHTML = []
        let i = 0
        for (const key in products) {
            i++
            const {
                productId,
                image,
                title,
                originalPrice,
                salePercent,
                currentPrice,
                sold,
                isShown
            } = products[key]
            productsHTML.push( `
                <tr>            
                                <td>${i}</td>
                                <td><img src="/public/assets/images/products/${image ? image : ''}" style="width: 50px" alt=""></td>
                                                            <td style="max-width: 200px;">
                                                                <p style=" word-wrap: break-word;
                                white-space: normal;
                                overflow: hidden;
                                display: -webkit-box;
                                text-overflow: ellipsis;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 2; ">${title}</p>
                                </td>
                                <td>${Number(originalPrice).toLocaleString('en-US', priceFormatOption)}đ</td>
                                <td>${salePercent}</td>
                                <td>${Number(currentPrice).toLocaleString('en-US', priceFormatOption)}đ</td>
                                <td>${sold}</td>
                                <td>
                                <?php
                                if ($this->checkRole('product-toggle')) :
                                ?>
                                        <div>
                                                <a class="btn btn-primary btn-custom toggle-btn" data-id="${productId}" data-show="${isShown}" href="javascript:void(0)">${ isShown == 1 ? 'Ẩn' : 'Hiện'}</a>
                                            </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-detail')) :
                                    ?>
                                        <div> <a class="btn btn-success btn-custom" href="/admin/product/detail/${productId}">Chi tiết</a></div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-delete')) :
                                    ?>
                                      <div>
                                                <a class="btn btn-danger btn-custom delete-btn" data-id="${productId}" href="javascript:void(0)">Xóa</a>
                                            </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-edit')) :
                                    ?>
                                        <div>
                                        <a href="/admin/product/edit/${productId}" class="btn btn-warning btn-custom">Chỉnh sửa</i>
                                    </a></div>
                                    <?php endif; ?>
                                </td>
                            </tr>   
                    `)
        }
        $('.product-table-body').html(productsHTML)
    }

    function filterProduct(catesFilter) {
        $.ajax({
            type: 'POST',
            url: `/admin/product/filter`,
            data: {
                catesFilter: [catesFilter]
            },
            success: function(response) {
                if (response && JSON.parse(response).status == 1) {
                    updateProductsTable(response)
                }
            },
        });
    }

    function importProducts() {
        $('.err-msg').html('')
        if ($('#import')[0].files.length <= 0) {
            $('.import-err-msg').html('Chưa chọn file...')
        } else {
            const formData = new FormData();
            formData.append('import', $('#import')[0].files[0]);
            $.ajax({
                type: 'POST',
                url: '/admin/product/import',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        updateProductsTable(response)
                    } else {
                        $('.import-err-msg').html(JSON.parse(response).errMsg)
                    }
                },
            });
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
                    url: `/admin/product/delete`,
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
    $(document).on('click', '.toggle-btn', function() {
        let btn = $(this)
        console.log(btn);
        let show = $(this).data('show')
        Swal.fire({
            ...confirmPopup,
            title: `${show == 1 ? 'Ẩn' : "Hiện"} sản phẩm này ?`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/product/toggle`,
                    data: {
                        id: $(this).data('id'),
                        show: show == 1 ? 0 : 1
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            btn.text(`${show == 1 ? 'Hiện' : "Ẩn"}`)
                            btn.data('show', `${show == 1 ? 0 : 1}`)
                        }
                    },
                });
            }
        })
    })
</script>
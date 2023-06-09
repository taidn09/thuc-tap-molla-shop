<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách đánh giá của khách hàng</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số sao</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Thời gian</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="review-table-body">
                        <?php
                        $userModel = new UserModel();
                        $productModel = new ProductModel();
                        foreach ($reviews as $review) {
                            $user = $userModel->getUserById($review['userId']);
                            $product = $productModel->getProductById($review['productId']);
                        ?>
                            <tr>
                                <td><?= $user['fname'] ? $user['fname'] . ' ' . $user['lname'] : $user['email'] ?></td>
                                <td><?= $product['title'] ?></td>
                                <td><?= $review['star'] ?></td>
                                <td><?= $review['title'] ?></td>
                                <td style="max-width: 250px;">
                                    <p style=" word-wrap: break-word;
                                white-space: normal;
                                overflow: hidden;
                                display: -webkit-box;
                                text-overflow: ellipsis;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 2;">
                                        <?= $review['content'] ?>
                                    </p>
                                </td>
                                <td>
                                    <?= $review['reviewTime'] ?>
                                </td>
                                <td>
                                    <?php
                                    if ($this->checkRole('review-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $review['reviewId'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('review-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/review/edit/<?= $review['reviewId'] ?>" class="btn btn-warning btn-custom">Chỉnh sửa</i>
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
            title: 'Xóa đánh giá này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/review/delete`,
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
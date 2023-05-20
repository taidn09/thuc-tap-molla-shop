<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Đánh giá</h5>

                <h3 class="text-center text-uppercase">Chỉnh sửa đánh giá</h3>
                <div class="row">

                    <div class="col-lg-12">
                        <?php
                        $userModel = new UserModel();
                        $productModel = new ProductModel();
                        $user = $userModel->getUserById($review['userId']);
                        $product = $productModel->getProductById($review['productId']);
                        ?>
                        <p>Đang chỉnh sửa đánh giá của khách hàng : <?= $user['fname'] ? $user['fname'] . ' ' . $user['lname'] : $user['email'] ?> - Sản phẩm: <?= $product['title'] ?></p>
                        <form id="review-form" action="/admin/review/edit" method="post" class="mx-auto">
                            <input type="text" name="id" hidden value="<?= $review['reviewId'] ?>">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Số sao</label>
                                        <select name="star" class="form-control" id="star">
                                            <option <?=$review['star'] == 5 ? 'selected': '' ?> value="5">5 sao</option>
                                            <option <?=$review['star'] == 4 ? 'selected': '' ?> value="4">4 sao</option>
                                            <option <?=$review['star'] == 3 ? 'selected': '' ?> value="3">3 sao</option>
                                            <option <?=$review['star'] == 2 ? 'selected': '' ?> value="2">2 sao</option>
                                            <option <?=$review['star'] == 1 ? 'selected': '' ?> value="1">1 sao</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Tiêu đề</label>
                                        <input name="title" type="text" class="form-control" id="title" placeholder="" spellcheck="false" autocomplete="off" value="<?= $review['title'] ?>" />
                                        <div class="err-msg title-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group m-auto mt-2">
                                        <label for="reviewTime" class="form-label">Thời gian đánh giá</label>
                                        <input name="reviewTime" type="datetime-local" class="form-control" id="reviewTime" value="<?= $review['reviewTime'] ?>" />
                                        <div class="err-msg reviewTime-err-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group m-auto mt-2">
                                        <label for="content" class="form-label">Nội dung</label>
                                        <textarea name="content" type="text" class="form-control" id="content" placeholder="" spellcheck="false" autocomplete="off"><?= $review['content'] ?></textarea>
                                        <div class="err-msg content-err-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">
                                    Chỉnh sửa
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Sản phẩm</h5>
                <h3 class="text-center"><?= !empty($editMode) ? 'Sửa' : 'Thêm' ?> option cho s.phẩm <?= (new ProductModel())->getProductById($productId, true)['title'] ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        if (!empty($option)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="option-form" action="/admin/product/editOption/<?= $productId ?>" method="post" class="mx-auto">
                                    <?php
                                    ?>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="hidden" name="optionId" value="<?= $option['optionId'] ?>">
                                            <div class="form-group m-auto mt-2">
                                                <label for="color" class="form-label">Màu sắc</label>
                                                <select name="color" id="color" class="form-control form-select">
                                                    <?php
                                                    foreach ($colors as $color) {
                                                    ?>
                                                        <option value="<?= $color['color'] ?>" <?= $option['color'] == $color['color'] ? 'selected' : '' ?>><?= $color['text'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="err-msg color-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group m-auto mt-2">
                                                <label for="size" class="form-label">Kích cỡ</label>
                                                <select name="size" id="size" class="form-control">
                                                    <option <?= $option['size'] == 'S' ? 'selected' : '' ?> value="S">Small - S</option>
                                                    <option <?= $option['size'] == 'M' ? 'selected' : '' ?> value="M">Medium - M</option>
                                                    <option <?= $option['size'] == 'L' ? 'selected' : '' ?> value="L">Large - L</option>
                                                    <option <?= $option['size'] == 'XL' ? 'selected' : '' ?> value="XL">Extra large - XL</option>
                                                    <option <?= $option['size'] == 'XXL' ? 'selected' : '' ?> value="XXL">Extra Extra Large - XXL</option>
                                                </select>
                                                <div class="err-msg size-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group m-auto mt-2">
                                                <label for="quantity" class="form-label">Số lượng</label>
                                                <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Nhập số lượng..." spellcheck="false" autocomplete="off" value="<?= $option['quantity'] ?>" />
                                                <div class="err-msg quantity-err-msg"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="err-msg existed-err-msg">

                                    </div>
                                    <div class="form-group mt-2 m-auto">
                                        <a class="btn btn-custom btn-primary" href="javascript:void(0)" onclick="window.history.back()" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Chỉnh sửa thuộc tính
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } else { ?>

                        <div class="col-lg-12">
                            <form id="option-form" action="/admin/product/addOption/<?= $productId ?>" method="post" class="mx-auto">
                                <?php
                                ?>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="color" class="form-label">Màu sắc</label>
                                            <select name="color" id="color" class="form-control form-select">
                                                <?php
                                                foreach ($colors as $color) {
                                                ?>
                                                    <option value="<?= $color['color'] ?>"><?= $color['text'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="err-msg color-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="size" class="form-label">Kích cỡ</label>
                                            <select name="size" id="size" class="form-control">
                                                <option value="S">Small - S</option>
                                                <option value="M">Medium - M</option>
                                                <option value="L">Large - L</option>
                                                <option value="XL">Extra large - XL</option>
                                                <option value="XXL">Extra Extra Large - XXL</option>
                                            </select>
                                            <div class="err-msg size-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group m-auto mt-2">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Nhập số lượng..." spellcheck="false" autocomplete="off" value="<?= !empty($_POST['quantity']) ? $_POST['quantity'] : 0 ?>" />
                                            <div class="err-msg quantity-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="err-msg existed-err-msg">

                                </div>
                                <div class="form-group mt-2 m-auto">
                                    <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                        Thêm thuộc tính
                                    </button>
                                    <a class="btn btn-custom btn-primary" href="javascript:void(0)" onclick="window.history.back()" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                                </div>
                            </form>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Sản phẩm</h5>
                <h3 class="text-center"><?= !empty($editMode) ? 'Sửa sản phẩm ' . $product['title'] : 'Thêm sản phẩm' ?></h3>
                <div class="row">
                    <?php
                    if (!empty($editMode)) {
                        if (!empty($product)) {
                    ?>
                            <div class="col-lg-12">
                                <form id="product-form" action="/admin/product/edit" method="post" class="mx-auto">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="hidden" name="id" value="<?= $product['productId'] ?>">
                                            <div class="form-group m-auto mt-2">
                                                <label for="title" class="form-label">Tên sản phẩm</label>
                                                <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tên sản phẩm..." spellcheck="false" autocomplete="off" value="<?= $product['title'] ?>" />
                                                <div class="err-msg title-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="originalPrice" class="form-label">Giá</label>
                                                <input name="originalPrice" type="text" class="form-control" id="originalPrice" placeholder="Nhập tên sản phẩm..." spellcheck="false" autocomplete="off" value="<?= $product['originalPrice'] ?>" />
                                                <div class="err-msg originalPrice-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group m-auto mt-2">
                                                <label for="salePercent" class="form-label">Giảm giá (%)</label>
                                                <input name="salePercent" type="text" class="form-control" id="salePercent" placeholder="Giả giá..." spellcheck="false" autocomplete="off" value="<?= $product['salePercent'] ?>" />
                                                <div class="err-msg salePercent-err-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="category" class="form-label">Danh mục</label>
                                            <select name="categoryId" class="form-select" id="category">
                                                    <?php
                                                    $categoryModel = new CategoryModel();
                                                    $categories = $categoryModel->getCategoriesList();
                                                    foreach ($categories as $category) :
                                                    ?>
                                                        <option value="<?= $category['categoryId'] ?>" <?php if($category['categoryId'] == $product['categoryId']) echo 'selected'; ?>><?= $category['title']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <div class="err-msg category-err-msg"></div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="desc" class="form-label">Mô tả sản phẩm</label>
                                            <textarea name="desc" id="desc" class="form-control" rows="6" autocomplete="off" spellcheck="false"><?= $product['description'] ?></textarea>
                                            <div class="err-msg desc-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="err-msg existed-err-msg">

                                    </div>
                                    <div class="form-group mt-2 m-auto">
                                        <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                            Sửa sản phẩm
                                        </button>
                                        <a href="/admin/product" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    <?php } else { ?>

                        <div class="col-lg-12">
                            <form id="product-form" action="/admin/product/add" method="post" class="mx-auto">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="title" class="form-label">Tên sản phẩm</label>
                                            <input name="title" type="text" class="form-control" id="title" placeholder="Nhập tên sản phẩm..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg title-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="originalPrice" class="form-label">Giá</label>
                                            <input name="originalPrice" type="text" class="form-control" id="originalPrice" placeholder="Nhập giá sản phẩm..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg originalPrice-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="salePercent" class="form-label">Giảm giá (%)</label>
                                            <input name="salePercent" type="text" class="form-control" id="salePercent" placeholder="Giả giá..." spellcheck="false" autocomplete="off" />
                                            <div class="err-msg salePercent-err-msg"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group m-auto mt-2">
                                            <label for="category" class="form-label">Danh mục</label>
                                            <select name="categoryId" class="form-select" id="category">
                                                    <?php
                                                    $categoryModel = new CategoryModel();
                                                    $categories = $categoryModel->getCategoriesList();
                                                    foreach ($categories as $category) :
                                                    ?>
                                                        <option value="<?= $category['categoryId'] ?>"><?= $category['title']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <div class="err-msg category-err-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group m-auto mt-2">
                                        <label for="desc" class="form-label">Mô tả sản phẩm</label>
                                        <textarea name="desc" id="desc" class="form-control" rows="6" autocomplete="off" spellcheck="false"></textarea>
                                        <div class="err-msg desc-err-msg"></div>
                                    </div>
                                </div>
                                <div class="err-msg existed-err-msg">

                                </div>
                                <div class="form-group mt-2 m-auto">
                                    <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                        Thêm sản phẩm
                                    </button>
                                    <a href="/admin/product" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
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
<script>
    var selectBoxElement = document.querySelector('#category');

    dselect(selectBoxElement, {
        search: true,
        maxHeight: '200px'
    });
</script>
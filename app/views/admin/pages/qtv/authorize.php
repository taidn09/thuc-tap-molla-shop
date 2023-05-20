<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="col-lg-12">
                    <h2 class="text-center mt-3">Phân quyền</h2>
                    <?php
                    $adminObj = new AdminModel();
                    if (!empty($_GET['id'])) {
                        $admin = $adminObj->getAdminById(1, $_GET['id']);
                    }
                    if (!empty($admin)) {
                        $rolesArr = array();
                        $roles = $adminObj->getRoles($admin['adminId']);

                        $values_array = array();
                        foreach ($roles as $item) {
                            $values_array[] = $item['roleString'];
                        }
                        if (!empty($values_array) && is_array($values_array)) {
                            $rolesArr = $values_array;
                        }
                        // echo '<pre>';
                        // print_r($rolesArr);
                        // echo '</pre>';
                    ?>
                        <div>
                            <p>Quản trị viên: <?= $admin['name'] ?> - Email: <?= $admin['email'] ?> </p>
                        </div>
                        <p>Quyền hạn:</p>
                        <form action="/admin/admin/authorize" id="authorize-form" method="post" class="mx-auto" style="max-width: 100%; width: 800px !important" enctype="multipart/form-data">
                            <input type="hidden" name="adminId" value="<?= $admin['adminId'] ?>">
                            <input class="form-check-input" name="roles[]" type="checkbox" hidden checked value="dashboard">
                            <p class="mt-3">Danh sách sản phẩm</p>
                            <div class="gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('product', $rolesArr)) echo 'checked' ?> value="product" id="accessProduct">
                                    <label class="form-check-label" for="accessProduct">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-detail', $rolesArr)) echo 'checked' ?> value="product-detail" id="detailProduct">
                                    <label class="form-check-label" for="detailProduct">
                                        Xem chi tiết
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-delete', $rolesArr)) echo 'checked' ?> value="product-delete" id="deleteProduct">
                                    <label class="form-check-label" for="deleteProduct">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-edit', $rolesArr)) echo 'checked' ?> value="product-edit" id="editProduct">
                                    <label class="form-check-label" for="editProduct">
                                        Sửa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-add', $rolesArr)) echo 'checked' ?> value="product-add" id="addProduct">
                                    <label class="form-check-label" for="addProduct">
                                        Thêm
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-toggle', $rolesArr)) echo 'checked' ?> value="product-toggle" id="toggleProduct">
                                    <label class="form-check-label" for="toggleProduct">
                                        Ẩn/ hiện
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-addOption', $rolesArr)) echo 'checked' ?> value="product-addOption" id="addOption">
                                    <label class="form-check-label" for="addOption">
                                        Thêm option
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-editOption', $rolesArr)) echo 'checked' ?> value="product-editOption" id="optionProduct">
                                    <label class="form-check-label" for="optionProduct">
                                        Sửa option
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-deleteOption', $rolesArr)) echo 'checked' ?> value="product-deleteOption" id="deleteOption">
                                    <label class="form-check-label" for="deleteOption">
                                        Xóa option
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-uploadProductImages', $rolesArr)) echo 'checked' ?> value="product-uploadProductImages" id="uploadProductImages">
                                    <label class="form-check-label" for="uploadProductImages">
                                        Upload hình ảnh
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-deleteImage', $rolesArr)) echo 'checked' ?> value="product-deleteImage" id="deleteImage">
                                    <label class="form-check-label" for="deleteImage">
                                        Xóa hình ảnh
                                    </label>
                                </div>
                                <!-- <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('product-export', $rolesArr)) echo 'checked' ?> value="product-export" id="exportProduct">
                                    <label class="form-check-label" for="exportProduct">
                                        Xuất
                                    </label>
                                </div> -->
                            </div>
                            <p class="mt-3">Danh mục sản phẩm</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('category', $rolesArr)) echo 'checked' ?> value="category" id="accessCategory">
                                    <label class="form-check-label" for="accessCategory">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('category-delete', $rolesArr)) echo 'checked' ?> value="category-delete" id="deleteCategory">
                                    <label class="form-check-label" for="deleteCategory">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('category-edit', $rolesArr)) echo 'checked' ?> value="category-edit" id="editCategory">
                                    <label class="form-check-label" for="editCategory">
                                        Sửa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('category-add', $rolesArr)) echo 'checked' ?> value="category-add" id="addCategory">
                                    <label class="form-check-label" for="addCategory">
                                        Thêm
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Quản lý khách hàng</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('user', $rolesArr)) echo 'checked' ?> value="user" id="accessUser">
                                    <label class="form-check-label" for="accessUser">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="roles[]" type="checkbox" <?php if (in_array('user-detail', $rolesArr)) echo 'checked' ?> value="user-detail" id="detailUser">
                                    <label class="form-check-label" for="detailUser">
                                        Xem chi tiết
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('user-edit', $rolesArr)) echo 'checked' ?> value="user-edit" id="editUser">
                                    <label class="form-check-label" for="editUser">
                                        Sửa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('user-add', $rolesArr)) echo 'checked' ?> value="user-add" id="addUser">
                                    <label class="form-check-label" for="addUser">
                                        Thêm
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Danh sách đơn hàng</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('order', $rolesArr)) echo 'checked' ?> value="order" id="accessOrder">
                                    <label class="form-check-label" for="accessOrder">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('order-delete', $rolesArr)) echo 'checked' ?> value="order-delete" id="deleteOrder">
                                    <label class="form-check-label" for="deleteOrder">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('order-edit', $rolesArr)) echo 'checked' ?> value="order-edit" id="editOrder">
                                    <label class="form-check-label" for="editOrder">
                                        Sửa
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Đánh giá sản phẩm</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('review', $rolesArr)) echo 'checked' ?> value="review" id="accessReviews">
                                    <label class="form-check-label" for="accessReviews">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('review-delete', $rolesArr)) echo 'checked' ?> value="review-delete" id="deleteReview">
                                    <label class="form-check-label" for="deleteReview">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('review-edit', $rolesArr)) echo 'checked' ?> value="review-edit" id="editReview">
                                    <label class="form-check-label" for="editReview">
                                        Sửa
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Quản lý tin tức</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('blog', $rolesArr)) echo 'checked' ?> value="blog" id="accessBlog">
                                    <label class="form-check-label" for="accessBlog">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('blog-detail', $rolesArr)) echo 'checked' ?> value="blog-detail" id="detailBlog">
                                    <label class="form-check-label" for="detailBlog">
                                        Xem chi tiết
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('blog-delete', $rolesArr)) echo 'checked' ?> value="blog-delete" id="deleteBlog">
                                    <label class="form-check-label" for="deleteBlog">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('blog-edit', $rolesArr)) echo 'checked' ?> value="blog-edit" id="editBlog">
                                    <label class="form-check-label" for="editBlog">
                                        Sửa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('blog-toggle', $rolesArr)) echo 'checked' ?> value="blog-toggle" id="toggleBlog">
                                    <label class="form-check-label" for="toggleBlog">
                                        Ẩn/hiện
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Liên hệ</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('contact', $rolesArr)) echo 'checked' ?> value="contact" id="accessContact">
                                    <label class="form-check-label" for="accessContact">
                                        Truy cập
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('contact-delete', $rolesArr)) echo 'checked' ?> value="contact-delete" id="deleteContact">
                                    <label class="form-check-label" for="deleteContact">
                                        Xóa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" <?php if (in_array('contact-reply', $rolesArr)) echo 'checked' ?> value="contact-reply" id="editContact">
                                    <label class="form-check-label" for="editContact">
                                        Phản hồi
                                    </label>
                                </div>
                            </div>
                            <p class="mt-3">Thống kê</p>
                            <div class="d-flex gap-5">
                                <div class="form-check">
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" <?php if (in_array('statistics', $rolesArr)) echo 'checked' ?> value="statistics" id="accessStatistic">
                                    <label class="form-check-label" for="accessStatistic">
                                        Truy cập
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-custom btn-primary px-5 py-2">Hoàn thành</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    var checkAllCheckboxes = document.querySelectorAll('.check-all');
    checkAllCheckboxes.forEach(function(checkbox) {

        checkbox.addEventListener('change', function() {
            var groupCheckboxes = checkbox.parentNode.parentNode.querySelectorAll('input[type="checkbox"]:not(.check-all)');
            groupCheckboxes.forEach(function(groupCheckbox) {
                groupCheckbox.disabled = !checkbox.checked;

            });
        });
    });
    window.addEventListener("DOMContentLoaded", function() {
        checkAllCheckboxes.forEach(function(checkbox) {
            var groupCheckboxes = checkbox.parentNode.parentNode.querySelectorAll('input[type="checkbox"]:not(.check-all)');
            groupCheckboxes.forEach(function(groupCheckbox) {
                groupCheckbox.disabled = !checkbox.checked;
            });
        });
    })
</script>
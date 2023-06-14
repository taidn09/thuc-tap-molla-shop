<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="col-lg-12">
                    <h2 class="text-center mt-3">Phân quyền</h2>
                    <div class="form-control">
                        <label for="positions">Chọn chức vụ muốn phân quyền</label>
                        <select name="id" id="positions" class="form-control">
                            <?php
                            foreach ($positions as $key => $position) {
                            ?>
                                <option value="<?= $position['id'] ?>"><?= $position['job_title'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <h6 class="my-3">Quyền hạn:</h6>
                    <form action="/admin/position/authorize" id="postion-authorize-form" method="post" class="mx-auto">
                        <input type="hidden" name="id" id="id" readonly value="<?= $positions[0]['id'] ?>">
                        <table class="table table-bordered text-center" id="roles-table">
                            <tr>
                                <th class="text-start">Bảng</th>
                                <th>Truy cập</th>
                                <th>Xem chi tiết</th>
                                <th>Thêm</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                                <th>Ẩn/hiện</th>
                                <th>Nhập</th>
                                <th>Xuất</th>
                            </tr>
                            <tr>
                                <td class="text-start">Sản phẩm</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="product" id="accessProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-detail" id="detailProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-add" id="addProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-delete" id="deleteProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-edit" id="editProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-toggle" id="toggleProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-import" id="importProduct"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-export" id="exportProduct"></td>
                            </tr>
                            <tr>
                                <td class="text-start">Thư viện ảnh</td>
                                <td>
                                    <input class="form-check-input check-all" name="roles[]" type="checkbox" value="product-accessImages" id="accessImages">
                                </td>
                                <td><i class="bi bi-x"></i></td>
                                <td>
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-uploadProductImages" id="uploadProductImages">
                                </td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-deleteImage" id="deleteImage"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Thuộc tính sản phẩm</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="product-accessOptions" id="accessOptions"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-addOption" id="addOption"></td>
                                <td>
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-deleteOption" id="deleteOption">
                                </td>
                                <td>
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" value="product-editOption" id="optionProduct">
                                </td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Danh mục</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="category" id="accessCategory"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="category-add" id="addCategory"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="category-delete" id="deleteCategory"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="category-edit" id="editCategory"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Khách hàng</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="user" id="accessUser"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="user-detail" id="detailUser"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="user-add" id="addUser"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="user-delete" id="deleteUser"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="user-edit" id="editUser"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Đơn hàng</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="order" id="accessOrder"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="order-detail" id="detailOrder"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td>
                                    <input class="form-check-input" disabled name="roles[]" type="checkbox" value="order-delete" id="deleteOrder">
                                </td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="order-edit" id="editOrder"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Đánh giá</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="review" id="accessReviews"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="review-delete" id="deleteReview"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="review-edit" id="editReview"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Danh mục tin tức</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="blogCategory" id="accessBlogCate"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blogCategory-add" id="addblogCategory"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blogCategory-delete" id="deleteblogCategory"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blogCategory-edit" id="editblogCategory"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Tin tức</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="blog" id="accessBlog"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blog-detail" id="detailBlog"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blog-add" id="addBlog"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blog-delete" id="deleteBlog"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blog-edit" id="editBlog"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="blog-toggle" id="toggleBlog"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Liên hệ</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="contact" id="accessContact"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="contact-delete" id="deleteContact"></td>
                                <td><input class="form-check-input" disabled name="roles[]" type="checkbox" value="contact-reply" id="replyContact"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                            <tr>
                                <td class="text-start">Thống kê</td>
                                <td><input class="form-check-input check-all" name="roles[]" type="checkbox" value="statistics" id="accessStatistic"></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                                <td><i class="bi bi-x"></i></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-custom btn-primary px-5 py-2">Hoàn thành</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    $('#positions').change(function(){
        $('#id').val($('#positions').val())
        getRoles()
    })
    $('input.check-all').each(function() {
        var checkbox = $(this);
        var groupCheckboxes = checkbox.closest('tr').find('input[type="checkbox"]:not(.check-all)');
        checkbox.on('change', function() {
            var isChecked = checkbox.prop('checked');
            groupCheckboxes.prop('disabled', !isChecked);
        });
    });
    function getRoles() {
        $.ajax({
            type: 'POST',
            url: '/admin/position/getRoles',
            data: {
                id: $('#positions').val()
            },
            success: function(response) {
                if (response) {
                    if (JSON.parse(response).status == 1) {
                        let roleArr = JSON.parse(response).roleArr;
                        // $('input[type="checkbox"]:not([hidden]):not(.check-all)').prop('checked', false);
                        $('input[type="checkbox"]:not([hidden])').prop('checked', false);
                        $('input[type="checkbox"]:not([hidden]):not(.check-all)').prop('disabled', true);
                        $('input[type="checkbox"]:not([hidden])').each(function() {
                            var checkbox = $(this);
                            if ($.inArray(checkbox.val(), roleArr) !== -1) {
                                checkbox.prop('checked', true);
                                if (checkbox.hasClass('check-all')) {
                                    var groupCheckboxes = checkbox.closest('tr').find('input[type="checkbox"]:not(.check-all)');
                                    var isChecked = checkbox.prop('checked');
                                    groupCheckboxes.prop('disabled', !isChecked);
                                }
                            }
                        });
                    }
                }
            },
        });
    }
    $('#postion-authorize-form').on('submit',function(e){
        e.preventDefault()
        $.ajax({
                type: 'POST',
                url: '/admin/position/authorize',
                data: $(this).serialize(),
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        window.location = '/admin/position'
                    }
                },
            });
    })
    $(document).ready(getRoles)
</script>
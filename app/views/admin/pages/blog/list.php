<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('blog-add')) :
        ?>
            <a href="/admin/blog/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm tin tức mới</a>
        <?php endif; ?>

        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh sách tin tức</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Mô tả ngắn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="blog-table-body">
                        <?php
                        $adminModel = new AdminModel();
                        foreach ($blogs as $key=>$blog) {
                            $author = $adminModel->getAdminById($blog['authorId']);
                        ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><img src="<?php echo _WEB_ROOT ?>/public/assets/images/blog/<?= $blog['thumbnail'] ?>" style="width: 50px" alt=""></td>
                                <td><?= $blog['title'] ?></td>
                                <td><?= $author['name'] ?></td>
                                <td><?= $blog['createdAt'] ?></td>
                                <td style="max-width: 250px;">
                                    <p style=" word-wrap: break-word;
    white-space: normal;
    overflow: hidden;
    display: -webkit-box;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;">
                                        <?= $blog['shortDesc'] ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                    if ($this->checkRole('blog-toggle')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-primary btn-custom toggle-btn" data-id="<?= $blog['blogId'] ?>" data-show="<?= $blog['isShown'] ?>" href="javascript:void(0)"><?= $blog['isShown'] == 1 ? 'Ẩn' : 'Hiện' ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-detail')) :

                                    ?>
                                        <div>
                                            <a class="btn btn-success btn-custom" href="/admin/blog/detail/<?= $blog['blogId'] ?>">Chi tiết</a>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-delete')) :
                                    ?>
                                        <div>
                                            <a class="btn btn-danger btn-custom delete-btn" data-id="<?= $blog['blogId'] ?>" href="javascript:void(0)">Xóa</a>
                                        </div>

                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-edit')) :
                                    ?>
                                        <div>
                                            <a href="/admin/blog/edit/<?= $blog['blogId'] ?>" class="btn btn-warning btn-custom">
                                                Chỉnh sửa</a>
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
            title: 'Xóa tin tức này ?'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/blog/delete`,
                    data: {
                        id: btn.data('id')
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            if (window.location.pathname == '/admin/blog') {
                                $('.datatable').DataTable().row(btn.parents('tr')).remove().draw(false)
                            }
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
            title: `${show == 1 ? 'Ẩn' : "Hiện"} tin tức này ?`
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: `/admin/blog/toggle`,
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
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
                            <th scope="col">Thumbnail</th>
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
                        foreach ($blogs as $blog) {
                            $author = $adminModel->getAdminById($blog['authorId']);
                        ?>
                            <tr>
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
                                        <a class="btn btn-primary btn-custom" onclick="toggleShowHide('<?= $blog['blogId'] ?>','<?= $blog['isShown'] ?>');" href="javascript:void(0)"><i class="bi <?= $blog['isShown'] == 1 ? 'bi-eye-slash' : 'bi-eye' ?>"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-detail')) :

                                    ?>
                                        <a class="btn btn-success btn-custom" href="/admin/blog/detail/<?= $blog['blogId'] ?>"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteBlog('<?= $blog['blogId'] ?>');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-edit')) :
                                    ?>
                                        <a href="/admin/blog/edit/<?= $blog['blogId'] ?>" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
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
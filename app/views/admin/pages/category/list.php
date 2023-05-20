<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <?php
        if ($this->checkRole('category-add')) :
        ?>
            <a href="/admin/category/add" class="text-white btn btn-custom btn-success ms-auto d-inline-block py-2 px-5 mb-4">Thêm danh mục mới</a>
        <?php endif; ?>

        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title text-uppercase">Danh mục sản phẩm</h5>
                </div>
                <table class="ui celled table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Tên danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="category-table-body">
                        <?php
                        foreach ($categoryList as $category) {
                        ?>
                            <tr>
                                <td><?= $category['title'] ?></td>
                                <td>
                                    <?php
                                    if ($this->checkRole('category-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteCategory('<?= $category['categoryId'] ?>');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('category-edit')) :
                                    ?>
                                        <a href="/admin/category/edit/<?= $category['categoryId'] ?>" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
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
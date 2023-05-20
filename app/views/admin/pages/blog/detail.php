<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div style="max-width: 100%;">
                    <?php
                    echo $blog['content']
                    ?>
                </div>
                <div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
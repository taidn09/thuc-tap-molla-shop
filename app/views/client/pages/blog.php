
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/blog">Tin tức</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php
                    if (count($blogList) > 0) {
                    ?>
                        <div class="entry-container max-col-2" data-layout="fitRows">
                            <?php
                            $adminModel = new AdminModel();
                            foreach ($blogList as $blog) {
                                $author = $adminModel->getAdminById($blog['authorId']);
                            ?>
                                <div class="blog entry-item col-sm-6">
                                    <article class="entry entry-grid">
                                        <figure class="entry-media">
                                            <a href="/blog/detail/<?=$blog['blogId']?>">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/<?=$blog['thumbnail']?>" alt="image desc">
                                            </a>
                                        </figure><!-- End .entry-media -->
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a href="#"><?= $author['name']?></a>
                                                </span>
                                                <span class="meta-separator">|</span>
                                                <a href="#"><?= $blog['createdAt'] ?></a>
                                                <span class="meta-separator">|</span>
                                                <a href="#"><?= $blog['commentsCount'] ?> bình luận</a>
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title">
                                                <a href="/blog/detail/<?= $blog['blogId'] ?>"><?= $blog['title'] ?></a>
                                            </h2><!-- End .entry-title -->
                                            <div class="entry-content">
                                                <p><?= $blog['shortDesc'] ?></p>
                                                <a href="/blog/detail/<?= $blog['blogId'] ?>" class="read-more">Xem chi tiết</a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </article><!-- End .entry -->
                                </div><!-- End .entry-item -->
                            <?php
                            }
                            ?>
                        </div><!-- End .entry-container -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Quay lại
                                    </a>
                                </li>
                                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item">
                                    <a class="page-link page-link-next" href="#" aria-label="Next">
                                        Kế tiếp <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php } else{?>
                        <h1 class="text-center">Không tìm thấy tin tức nào</h1>
                        <?php }?>

                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Tìm kiếm</h3><!-- End .widget-title -->

                            <form action="/product/search" method="POST">
                                <label for="ws" class="sr-only">Tìm kiếm tin tức</label>
                                <input type="hidden" name="table" value="blogs">
                                <input type="search" class="form-control" name="searchTerm" id="ws" placeholder="Nhập từ khóa để tìm kiếm" required>
                                <button type="submit" class="btn"><i class="icon-search"></i><span class="sr-only">Tìm</span></button>
                            </form>
                        </div><!-- End .widget -->

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Danh mục</h3><!-- End .widget-title -->

                            <ul>
                                <li><a href="#">Lifestyle<span>3</span></a></li>
                                <li><a href="#">Shopping<span>3</span></a></li>
                                <li><a href="#">Fashion<span>1</span></a></li>
                                <li><a href="#">Travel<span>3</span></a></li>
                                <li><a href="#">Hobbies<span>2</span></a></li>
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Tin tức nổi bật</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/sidebar/post-1.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 22, 2018</span>
                                        <h4><a href="#">Aliquam tincidunt mauris eurisus.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/sidebar/post-2.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 19, 2018</span>
                                        <h4><a href="#">Cras ornare tristique elit.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/sidebar/post-3.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 12, 2018</span>
                                        <h4><a href="#">Vivamus vestibulum ntulla nec ante.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/sidebar/post-4.jpg" alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 25, 2018</span>
                                        <h4><a href="#">Donec quis dui at dolor tempor interdum.</a></h4>
                                    </div>
                                </li>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
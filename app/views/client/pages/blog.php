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
                        <div class="entry-container max-col-2 blogs-container" data-layout="fitRows">
                            <?php
                            $adminModel = new AdminModel();
                            foreach ($blogList as $blog) {
                                $author = $adminModel->getAdminById($blog['authorId']);
                            ?>
                                <div class="blog entry-item col-sm-4">
                                    <article class="entry entry-grid">
                                        <figure class="entry-media">
                                            <a href="/blog/detail/<?= $blog['blogId'] ?>">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/<?= $blog['thumbnail'] ?>" alt="image desc">
                                            </a>
                                        </figure><!-- End .entry-media -->
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a href="#"><?= $author['name'] ?></a>
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
                            <ul class="pagination paginate-shop">
                                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link page-link-prev" href="#<?= $currentPage - 1 ?>" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Quay lại
                                    </a>
                                </li>
                                <?php
                                for ($i = 0; $i < $totalPage; $i++) {
                                ?>
                                    <li class="page-item <?= $i + 1 == $currentPage ? 'active' : '' ?>" aria-current="page"><a class="page-link" href="#<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
                                <?php
                                }
                                ?>
                                <li class="page-item-total">of <?= $totalPage ?></li>
                                <li class="page-item <?= $currentPage >= $totalPage ? 'disabled' : '' ?>">
                                    <a class="page-link page-link-next" href="#<?= $currentPage + 1 ?>" aria-label="Next">
                                        Kế tiếp <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php } else { ?>
                        <h1 class="text-center">Không tìm thấy tin tức nào</h1>
                    <?php } ?>

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
                        <div class="widget">
                            <h3 class="widget-title">Tin tức mới nhất</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <?php
                                foreach ($blogListFull as $key => $item) {
                                ?>
                                    <li>
                                        <figure>
                                            <a href="/blog/detail/<?= $item['blogId'] ?>">
                                                <img src="<?php echo _WEB_ROOT; ?>/public/assets/images/blog/<?= $item['thumbnail'] ?>" alt="post">
                                            </a>
                                        </figure>

                                        <div>
                                            <span><?= $item['createdAt'] ?></span>
                                            <h4 style=" word-wrap: break-word;
    white-space: normal;
    overflow: hidden;
    display: -webkit-box;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;"><a href="/blog/detail/<?= $item['blogId'] ?>"><?= $item['shortDesc'] ?></a></h4>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
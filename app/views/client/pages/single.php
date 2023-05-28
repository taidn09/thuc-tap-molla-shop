<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/blog">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?=
                    $blog['content'];
                    ?>
                    <nav class="pager-nav" aria-label="Page navigation">
                        <a class="pager-link pager-link-prev" href="<?= !empty($prevId) ? '/blog/detail/' . $prevId : '' ?>" aria-label="Previous" tabindex="-1">
                            Tin trước
                        </a>

                        <a class="pager-link pager-link-next" href="<?= !empty($nextId) ? '/blog/detail/' . $nextId : '' ?>" aria-label="Next" tabindex="-1">
                            Tin sau
                        </a>
                    </nav><!-- End .pager-nav -->
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
                                foreach ($blogs as $key => $item) {
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
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
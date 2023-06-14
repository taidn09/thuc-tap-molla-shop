<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <?php
        if ($this->checkRole('dashboard')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'home') echo 'active' ?>" href="/admin/dashboard">
                    <i class="bi bi-house-fill"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('product')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'product') echo 'active' ?>" href="/admin/product">
                    <i class="bi bi-table"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('category')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'category') echo 'active' ?>" href="/admin/category">
                    <i class="bi bi-grid"></i>
                    <span>Danh mục</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('user')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'user') echo 'active' ?>" href="/admin/user">
                    <i class="bi bi-people-fill"></i>
                    <span>Khách hàng</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('order')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'order') echo 'active' ?>" href="/admin/order">
                    <i class="bi bi-cash"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('contact')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'contact') echo 'active' ?>" href="/admin/contact">
                    <i class="bi bi-chat"></i>
                    <span>Liên hệ</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('review')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'review') echo 'active' ?>" href="/admin/review">
                    <i class="bi bi-star"></i>
                    <span>Đánh giá</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('blog')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'blog') echo 'active' ?>" href="/admin/blog">
                    <i class="bi bi-newspaper"></i>
                    <span>Tin tức</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('blogCategory')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'blog-category') echo 'active' ?>" href="/admin/blogCategory">
                    <i class="bi bi-newspaper"></i>
                    <span>Danh mục tin tức</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($this->checkRole('statistics')) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'statistics') echo 'active' ?>" href="/admin/statistics">
                <i class="bi bi-bar-chart-fill"></i>
                    <span>Thống kê</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($_SESSION['admin']['role'] == 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'admin') echo 'active' ?>" href="/admin/admin">
                    <i class="bi bi-people-fill"></i>
                    <span>Nhân viên</span>
                </a>
            </li>
        <?php } ?>
        <?php
        if ($_SESSION['admin']['role'] == 0) {
        ?>
            <li class="nav-item">
                <a class="nav-link <?php if ($controller == 'position') echo 'active' ?>" href="/admin/position">
                <i class="bi bi-list-ul"></i>
                    <span>Chức vụ</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</aside>
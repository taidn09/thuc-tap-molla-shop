<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/user" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <div class="">
                    <h5 class="card-title text-uppercase">Thông tin khách hàng</h5>
                    <div class="b-block">
                        <ul>
                            <li>Họ tên: <?= !empty($user['fname']) ? $user['fname'] . ' ' . $user['lname'] : 'Chưa cập nhật' ?></li>
                            <li>Email: <?= $user['email'] ?></li>
                            <li>Phone: <?= !empty($user['phone']) ? $user['phone'] : 'Chưa cập nhật' ?></li>
                            <li>Địa chỉ: <?= !empty($user['street']) ? $user['street'] . '-' . $user['ward'] . '-' . $user['district'] . '-' . $user['province'] : 'Chưa cập nhật' ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
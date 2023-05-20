<main id="main" class="main">
    <!-- Recent Sales -->
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
                        <a href="/admin/user" class="btn btn-custom btn-primary">Quay về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Sales -->
</main>

</script>
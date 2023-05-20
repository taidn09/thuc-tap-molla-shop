<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Đơn hàng</h5>

                <h3 class="text-center text-uppercase">Chỉnh sửa thông tin đơn hàng</h3>
                <div class="row">

                    <div class="col-lg-12">
                        <form id="order-form" action="/admin/order/edit" method="post" class="mx-auto">
                            <input type="text" name="id" hidden value="<?= $order['orderId'] ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Ngày đặt hàng</label>
                                        <input name="orderDate" type="date" class="form-control" id="orderDate" placeholder="" spellcheck="false" autocomplete="off" value="<?= $order['orderDate'] ?>" />
                                        <div class="err-msg orderDate-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Người nhận</label>
                                        <input name="receiver" type="text" class="form-control" id="receiver" placeholder="" spellcheck="false" autocomplete="off" value="<?= $order['receiver'] ?>" />
                                        <div class="err-msg receiver-err-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control" id="email" placeholder="" spellcheck="false" autocomplete="off" value="<?= $order['email'] ?>" />
                                        <div class="err-msg email-err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group m-auto mt-2">
                                        <label for="title" class="form-label">Phone</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="" spellcheck="false" autocomplete="off" value="<?= $order['phone'] ?>" />
                                        <div class="err-msg phone-err-msg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="province">Province</label>
                                    <select class="form-control" name="province" id="province">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="district">District</label>
                                    <select class="form-control" name="district" id="district">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ward">Ward</label>
                                    <select class="form-control" name="ward" id="ward">
                                    </select>
                                </div>
                                <input autocomplete="off" type="hidden" name="province-is" id="province-is">
                                <input autocomplete="off" type="hidden" name="district-is" id="district-is">
                                <input autocomplete="off" type="hidden" name="ward-is" id="ward-is">
                            </div>
                            <label for="street">Street - Apartment number</label>
                            <input autocomplete="off" type="text" id="street" value="<?= $order['street'] ?>" class="form-control" name="street">
                            <div class="street-err-msg err-msg"></div>
                            <div class="form-group mt-3">
                                <button class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">
                                    Chỉnh sửa
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
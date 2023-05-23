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
                                        <label for="title" class="form-label">Số điện thoại</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="" spellcheck="false" autocomplete="off" value="<?= $order['phone'] ?>" />
                                        <div class="err-msg phone-err-msg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="province">Tỉnh / thành phố</label>
                                    <select class="form-control" name="province" id="province">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="district">Quận / huyện</label>
                                    <select class="form-control" name="district" id="district">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="ward">Phường / xã</label>
                                    <select class="form-control" name="ward" id="ward">
                                    </select>
                                </div>
                                <input autocomplete="off" type="hidden" name="province-is" id="province-is">
                                <input autocomplete="off" type="hidden" name="district-is" id="district-is">
                                <input autocomplete="off" type="hidden" name="ward-is" id="ward-is">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="street">Số nhà - Tên đường</label>
                                        <input autocomplete="off" type="text" id="street" value="<?= $order['street'] ?>" class="form-control" name="street">
                                        <div class="street-err-msg err-msg"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="street">Trạng thái đơn hàng</label>
                                        <select name="code" id="code" class="form-select">
                                            <?php
                                            foreach ($statusCodes as  $code) {
                                            ?>
                                                <option value="<?= $code['id'] ?>" <?php if($code['id'] == $order['status']) echo 'selected'?>><?= $code['status_text'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="street-err-msg code-msg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="notes">Nội dung ghi chú</label>
                                    <textarea name="notes" id="notes" cols="30" rows="5" class="form-control"></textarea>
                                    <div class="err-msg notes-err-msg"></div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                
                                <button class="btn btn-custom btn-success" style="min-width: 200px; padding: 6px 32px !important">
                                    Chỉnh sửa
                                </button>
                                <a href="/admin/order" class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
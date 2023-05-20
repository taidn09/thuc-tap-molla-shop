<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Liên hệ</h5>

                <h3 class="text-center text-uppercase">Phản hồi liên hệ</h3>
                <div class="row">

                    <div class="col-lg-12">
                        <form id="contact-form" action="/admin/contact/edit" method="post" class="mx-auto">
                            <input type="text" name="id" hidden value="<?= $contact['id'] ?>">
                            <input type="text" name="email" hidden value="<?= $contact['email'] ?>">
                            <div class="row">
                                <!-- TinyMCE Editor -->
                                <label for="reply" class="mt-2">Trả lời</label>
                                <textarea id="reply" class="tinymce-editor" name="reply"><?=$contact['reply']?>
                                     </textarea><!-- End TinyMCE Editor -->
                                <div class="err-msg reply-err-msg"></div>
                            </div>
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
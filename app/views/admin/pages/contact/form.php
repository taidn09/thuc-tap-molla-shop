<main id="main" class="main">
    <!-- Recent Sales -->
    <a href="/admin/contact" class="btn btn-custom btn-primary mb-3" style="min-width: 200px; padding: 6px 32px !important">Quay về</a>
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Liên hệ</h5>

                <h3 class="text-center text-uppercase">Phản hồi liên hệ</h3>
                <div class="row">

                    <div class="col-lg-12">
                        <p>Người gửi : <?= $contact['name'] ?></p>
                        <p>Nội dung : <?= $contact['message'] ?></p>
                        <form id="contact-form" action="/admin/contact/edit" method="post" class="mx-auto">
                            <input type="text" name="id" hidden value="<?= $contact['id'] ?>">
                            <input type="text" name="email" hidden value="<?= $contact['email'] ?>">
                            <div class="row">
                                <!-- TinyMCE Editor -->
                                <label for="reply" class="mt-2">Trả lời:</label>
                                <textarea spellcheck="false" autocomplete="off" id="reply" class="tinymce-editor mt-3" name="reply"><?= $contact['reply'] ?>
                                     </textarea><!-- End TinyMCE Editor -->
                                <div class="err-msg reply-err-msg"></div>
                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-custom btn-primary" style="min-width: 200px; padding: 6px 32px !important">
                                    Gửi phản hồi
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Recent Sales -->
</main>
<script>
    $('#contact-form').on('submit', function(e) {
        e.preventDefault()
        let formData = $(this).serialize()
        let flag = true
        $(".err-msg").html('')
        if (tinymce.activeEditor.getContent().trim() !== '') {
            formData = formData + '&reply=' + tinymce.activeEditor.getContent().trim()
        } else {
            $(".reply-err-msg").html('Chưa nhập nội dung phản hồi cho khách hàng...')
            flag = false
        }
        if (flag) {
            Swal.fire({
                title: 'Đang tiến hành gửi email cho khách hàng...!',
                didOpen: () => {
                    Swal.showLoading()
                }
            })
            $.ajax({
                type: 'POST',
                url: '/admin/contact/reply',
                data: formData,
                success: function(response) {
                    checkAdminRoleValid(JSON.parse(response).status)
                    if (response && JSON.parse(response).status == 1) {
                        Swal.fire({
                            ...successPopup,
                            title: 'Phản hồi đã được gửi!',
                            showConfirmButton: true
                        }).then(result => {
                            window.location = "/admin/contact"
                        })
                    } else {
                        Swal.fire({
                            ...successPopup,
                            icon: 'error',
                            title: 'Đã có lỗi xảy ra!',
                        })
                    }
                },
            });
        }
    })
</script>
    <!-- Vendor JS Files -->

    <script src="/public/assets/admin/vendor/echarts/echarts.min.js"></script>
    <script src="/public/assets/admin/vendor/quill/quill.min.js"></script>
    <!-- Template Main JS File -->
    <script src="/public/assets/admin/js/main.js"></script>
    <script src="https://cdn.tiny.cloud/1/ygjovwhwhkrxihkzdmjlv7w3caaf8gq88788n5fr2spug4gx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="/public/assets/admin/js/tinymce.js"></script>

    <script src="/public/assets/admin/js/dev.js"></script>
    <script src="/public/assets/admin/js/validation-functions.js"></script>
    <script src="/public/assets/admin/js/api-adress.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#authorize-form').on('submit', function(e) {
            e.preventDefault()
            console.log($(this).serialize());
            $.ajax({
                type: 'POST',
                url: '/admin/admin/authorize',
                data: $(this).serialize(),
                success: function(response) {
                    if (response && JSON.parse(response).status == 1) {
                        Swal.fire({
                            ...successPopup,
                            title: 'Phân quyền thành công!',
                            showConfirmButton: true
                        }).then(result => {
                            if (result.isConfirmed) {
                                window.location = '/admin/admin'
                            }
                        })
                    }
                },
            });
        })
    </script>
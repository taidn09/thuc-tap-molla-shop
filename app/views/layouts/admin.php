<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Molla Admin - <?= !empty($title) ? $title : 'Home' ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="/public/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/public/assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/public/assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="/public/assets/admin/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="/public/assets/admin/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="/public/assets/admin/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="/public/assets/admin/css/style.css" rel="stylesheet" />
    <link href="/public/assets/admin/css/main.css" rel="stylesheet" />
    <script src="/public/assets/admin/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="/public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/admin/js/dselect.js"></script>
</head>

<body>
    <?php
    $this->checkAdminLogin();
    if ($_SERVER['PATH_INFO'] != '/admin/401' && $_SERVER['PATH_INFO'] != '/admin/404') {
        if (!$this->checkRole()) {
            $this->loadErrAuth();
        }
    }
    if ($_SERVER['REQUEST_URI'] != '/admin/dashboard/login' && $_SERVER['REQUEST_URI'] != '/admin/404' && $_SERVER['REQUEST_URI'] != '/admin/401') {
        $this->render('admin/blocks/header', $subcontent);
        $this->render('admin/blocks/sidebar', $subcontent);
    }
    $this->render($content, $subcontent);
    if ($_SERVER['REQUEST_URI'] != '/admin/dashboard/login' && $_SERVER['REQUEST_URI'] != '/admin/404' && $_SERVER['REQUEST_URI'] != '/admin/401') {
        $this->render('admin/blocks/footer');
    }

    ?>
    <!-- Vendor JS Files -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/chart.js/chart.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/echarts/echarts.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/quill/quill.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/main.js"></script>
    <script src="https://cdn.tiny.cloud/1/ygjovwhwhkrxihkzdmjlv7w3caaf8gq88788n5fr2spug4gx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="/public/assets/admin/js/tinymce.js"></script>
    <script src="/public/assets/admin/js/dev.js"></script>
    <script src="/public/assets/admin/js/validation-functions.js"></script>
    <script src="/public/assets/admin/js/data-table.js"></script>
    <script src="/public/assets/admin/js/api-adress.js"></script>
    <script>

        // ------------review 
        $('#review-form').on('submit', function(e) {
            e.preventDefault()
            let flag = true
            $('.err-msg').html('')
            var formData = $(this).serialize();
            if ($('#title').val() == '') {
                $('.title-err-msg').html('Chưa nhập tiêu đề')
                flag = false
            }
            if ($('#content').val() == '') {
                $('.title-err-msg').html('Chưa nhập nội dung...')
                flag = false
            }
            if ($('#reviewTime').val() == '') {
                $('.title-err-msg').html('Chưa chọn thời gian...')
                flag = false
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/review/edit',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            window.location = "/admin/review"
                        }
                    },
                });
            }
        })

        function updateReviewPage(response) {
            const {
                reviews
            } = JSON.parse(response)
            let reviewsHTML = ''
            for (const key in reviews) {
                const {
                    reviewId,
                    user,
                    product,
                    title,
                    star,
                    content,
                    reviewTime
                } = reviews[key]
                reviewsHTML += `
                <tr>
                                <td>${user.fname ? user.fname+ ' ' + user.lname : user.email}</td>
                                <td>${product.title}</td>
                                <td>${star}</td>
                                <td>${title}</td>
                                <td style="max-width: 250px;">
                                    <p style=" word-wrap: break-word;
                                        white-space: normal;
                                        overflow: hidden;
                                        display: -webkit-box;
                                        text-overflow: ellipsis;
                                        -webkit-box-orient: vertical;
                                        -webkit-line-clamp: 2;">
                                        ${content}
                                    </p>
                                </td>
                                <td>
                                ${reviewTime}
                                </td>
                                <td>
                                <?php
                                if ($this->checkRole('review-delete')) :
                                ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteReview('${reviewId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('review-edit')) :
                                    ?>
                                        <a href="/admin/review/edit/${reviewId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>                               
                                </td>
                            </tr>
                    `
            }
            let len = Object.keys(reviews).length
            $('.dataTable-info').html(`Đang hiển thị 1 đến ${$('.dataTable-selector').val() > len ? len : $('.dataTable-selector').val()} trong số ${len} kết quả tìm thấy`)
            $('.review-table-body').html(reviewsHTML)
        }

        function deleteReview(id) {
            if (id) {
                Swal.fire(confirmPopup).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/review/delete`,
                            data: {
                                id
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    // call fnc
                                    updateReviewPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa đánh giá thành công!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }
        // ------------end review
        // ------------------- admin
        $('#admin-form').on('submit', function(e) {
            e.preventDefault()
            const action = $(this).attr('action')
            let flag = true
            $('.err-msg').html('')
            const name = $(this).find('#name').val().trim()
            if (!name || name.length < 2 || name.length > 50) {
                $('.name-err-msg').html(`Nhập từ 2 đến 50 ký tự...`)
                flag = false
            }
            if (!validateEmailAdress($('#email').val())) {
                $('.email-err-msg').html(`Email không hợp lệ...`)
                flag = false
            }
            if ($('#password').val().trim() !== '' || $('#cfpassword').val().trim() !== '') {
                if ($('#password').val().trim().length < 6) {
                    $('.password-err-msg').html(`Mật khẩu tối thiểu 6 ký tự...`)
                    flag = false
                }
                if ($('#password').val().trim() != $('#cfpassword').val().trim()) {
                    $('.cfpassword-err-msg').html(`Mật khẩu nhập lại không khớp...`)
                    flag = false
                }
            }
            if ($('#image')[0].files.lenght <= 0) {
                $('.image-err-msg').html(`Vui lòng chọn hình ảnh...`)
                flag = false
            }
            if (flag) {
                var formData = new FormData();
                const action = $(this).attr('action')
                formData.append('name', name);
                formData.append('image', $('#image')[0].files[0]);
                formData.append('password', $('#password').val().trim());
                formData.append('email', $('#email').val().trim());
                formData.append('role', $('#role').val());
                if ($(this).find('#new-password').length != 0) {
                    formData.append('newPassword', $('#new-password').val());
                }
                if (action.includes('edit')) {
                    formData.append('id', $('#id').val());
                }
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            window.location = '/admin/admin'
                        } else {
                            if (JSON.parse(response).uploadErr) {
                                $('.image-err-msg').html(JSON.parse(response).uploadErr)
                            }
                            if (JSON.parse(response).emailErr) {
                                $('.email-err-msg').html(JSON.parse(response).emailErr)
                            }
                        }
                    },
                });
            }
        })

        function deleteAdmin(id) {
            if (id) {
                Swal.fire(confirmPopup).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/admin/delete`,
                            data: {
                                id
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    // call fnc
                                    updateAdminPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Đã xóa 1 nhân viên!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateAdminPage(response) {
            console.log(response);
            const {
                admins
            } = JSON.parse(response)
            let adminsHTML = ''
            for (const key in admins) {
                const {
                    adminId,
                    name,
                    email,
                    role,
                    image
                } = admins[key]
                adminsHTML += `
                <tr>
                                <td><img src="/public/assets/images/admin/${image}" alt="" style="width: 50px">
                                </td>
                                <td>${name}</td>
                                <td>${email}</td>
                                <td>${role == 0 ? 'Nhân viên' : 'Quản lý'}</td>
                                <td>
                                    <a href="/admin/admin/authorize/${adminId}" class="btn btn-custom btn-primary"><i class="bi bi-gear-wide"></i></a>
                                    <a class="btn btn-danger btn-custom" onclick="deleteAdmin('${adminId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <a href="/admin/admin/edit/${adminId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                </td>
                            </tr>
                    `
            }
            $('.admin-table-body').html(adminsHTML)
        }
        // ------------------- end admin
        // -----------------login
        $('#login-form').on('submit', function(e) {
            e.preventDefault()
            $('.login-err').css('display', 'none')
            let flag = true
            if ($('#email').val().trim() == '') {
                flag = false
            }
            if ($('#password').val().trim() == '') {
                flag = false
            }
            if (!flag) {
                $('.login-err').html('Vui lòng nhập đủ thông tin')
                $('.login-err').css('display', 'none')
            } else {
                const formData = $(this).serialize()
                $.ajax({
                    type: 'POST',
                    url: `/admin/dashboard/login`,
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            window.location = '/admin/dashboard'
                        } else {
                            Swal.fire({
                                ...successPopup,
                                icon: 'error',
                                title: 'Email hoặc mật khẩu không chính xác!'
                            })
                        }
                    },
                });
            }
        })
        // -----------------end login
        // ------------------ authorize
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
        // -------------------end authorize
        // --------------------statistics
        $('#report-form').on('submit', function(e) {
            e.preventDefault();
            let _this = $(this)
            let flag = true
            if (!$('#display-type-table').hasClass('d-none')) {
                $('#display-type-table').addClass('d-none')
            }
            if (!$('#pieChart').hasClass('d-none')) {
                $('#pieChart').addClass('d-none')
            }
            const inputs = $('.input-after-choose');
            const errorDiv = $('.err-msg');
            if (!errorDiv.hasClass('d-none')) {
                errorDiv.addClass('d-none')
            }
            inputs.each(function() {
                if (!$(this).hasClass('d-none')) {
                    if ($(this).attr('name') == 'from' && $(this).val() > _this.find('[name=to]').val()) {
                        const errorMessage = 'Ngày không hợp lệ';
                        errorDiv.text(errorMessage).removeClass('d-none');
                        flag = false
                    } else if (!$(this).val()) {
                        const errorMessage = 'Vui lòng chọn phương thức thống kê';
                        errorDiv.text(errorMessage).removeClass('d-none');
                        flag = false
                    }
                }
            });
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/statistics',
                    data: _this.serializeArray(),
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            var {
                                result
                            } = JSON.parse(response)
                            const typeReport = _this.find('[name=typeReport]').val()
                            if (_this.find('[name=typeDisplay]').val() == 2) {
                                var dataArray = [];
                                result.forEach(item => {
                                    const {
                                        color,
                                        size,
                                        title
                                    } = item
                                    dataArray.push({
                                        value: typeReport == 1 ? item.soldQty : item.total,
                                        name: title
                                    })
                                })
                                if ($('#pieChart').hasClass('d-none')) {
                                    $('#pieChart').removeClass('d-none')
                                }
                                echarts.init(document.querySelector("#pieChart")).setOption({
                                    title: {
                                        text: `Statistics by ${typeReport == 1 ? 'sold quantity' :
                                            'doanh thu (đ)'}`,
                                        left: 'center'
                                    },
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        orient: 'vertical',
                                        left: 'left',
                                        top: 30
                                    },
                                    textStyle: {
                                        fontFamily: 'monospace'
                                    },
                                    series: [{
                                        name: 'Sản phẩm',
                                        type: 'pie',
                                        radius: '50%',
                                        data: dataArray,
                                        emphasis: {
                                            itemStyle: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                            }
                                        }
                                    }]
                                });
                            } else {
                                if ($('#display-type-table').hasClass('d-none')) {
                                    $('#display-type-table').removeClass('d-none')
                                }
                                let _html = ''
                                let summary = 0;
                                result.forEach(item => {
                                    summary += (typeReport == 1) ? Number(item.soldQty) : Number(item.total)
                                    const {
                                        color,
                                        size,
                                        title
                                    } = item
                                    _html += `
                                    <tr>
                                            <td>${title}</td>
                                            <td>${typeReport == 1 ? item.soldQty : item.total+'đ'}</td>
                                    </tr>
                                `
                                })
                                $('#display-type-table').html(`
                                <thead>
                                        <th>Tên sản phẩm</th>
                                        <th>${typeReport == 1 ? 'Số lượng bán' : 'Doanh số'}</th>
                                    </thead>
                                    <tbody>
                                    ${_html}
                                    <tr>
                                    <td colspan='2' class="text-center">Tổng ${typeReport == 1 ? "số lượng: "+ summary.toLocaleString('en-US', priceFormatOption) : 'doanh thu: ' + summary.toLocaleString('en-US', priceFormatOption)+'đ'}</td></tr>
                                    </tbody>
                                `)
                            }
                        }
                    },
                });
            }

        })
        // --------------------end statistics
        // ----------------- đổi mật khẩu 
        $('#changPass-form').on('submit', function(e) {
            e.preventDefault();
            let flag = true
            const password = $('#password').val().trim()
            const newpass = $('#newpass').val().trim()
            const cfpass = $('#cfpass').val().trim()
            const id = $('#id').val().trim()
            if (id == '') {
                flag = false
            }
            if (password == '') {
                flag = false
                $('.password-err-msg').html('Vui lòng nhập mật khẩu...')
            }
            if (newpass.length < 6) {
                flag = false
                $('.newpass-err-msg').html('Mật khẩu tối thiểu 6 ký tự...')
            }
            if (newpass != cfpass) {
                flag = false
                $('.cfpass-err-msg').html('Mật khẩu nhập lại không khớp...')
            }
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/dashboard/changePassword',
                    data: {
                        id,
                        password,
                        newpass
                    },
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            window.location = '/admin/dashboard/'
                        } else {
                            $('.password-err-msg').html(JSON.parse(response).errMsg)
                        }
                    },
                });
            }
        })
        // ------------------ end đổi mật khẩu
        function exportExcel() {
            $.ajax({
                url: '/admin/product/export',
                xhrFields: {
                    responseType: 'blob'
                },
                success: async function(data, textStatus, xhr) {
                    try {
                        const filename = xhr.getResponseHeader('Content-Disposition').match(/filename="(.+)"/)[1];
                        const handle = await window.showSaveFilePicker({
                            suggestedName: filename
                        });
                        const writable = await handle.createWritable();
                        await writable.write(await data.arrayBuffer());
                        await writable.close();
                        Swal.fire({
                            ...successPopup,
                            title: 'Đã xuất file thành công !'
                        })
                    } catch (error) {
                        Swal.fire({
                            ...successPopup,
                            text: error
                        })
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        ...successPopup,
                        text: error
                    })
                }
            });
        }
    </script>
</body>

</html>
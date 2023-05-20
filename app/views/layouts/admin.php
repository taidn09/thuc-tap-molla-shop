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
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/simple-datatables/style.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/css/style.css" rel="stylesheet" />
    <link href="<?php echo _WEB_ROOT; ?>/public/assets/admin/css/main.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/dselect.js"></script>
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
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/simple-datatables/simple-datatables.js"></script>
    <!-- <script src="/public/assets/admin/vendor/tinymce/tinymce.min.js"></script> -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/main.js"></script>
    <script src="<?php echo _WEB_ROOT; ?>/public/assets/admin/js/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/pa7min7owpkxlj4fj1lyqvjg940ozhuqd5gg3k426f7okyyf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        const confirmPopup = {
            title: 'Bạn có chắc muốn xóa bản ghi này không?',
            text: "Nhấn đóng để hủy!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa!',
            cancelButtonText: 'Đóng!'
        }
        const successPopup = {
            position: 'center',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }
        const priceFormatOption = {
            useGrouping: true,
            maximumFractionDigits: 0,
        }
        // tinyMCE editor
        tinymce.init({
            selector: '.tinymce-editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
        // get addess by api
        if ($("#province").length) {
            const host = "https://provinces.open-api.vn/api/";
            var callAPI = (api) => {
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response, "province");
                    callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
                });
            };
            callAPI("https://provinces.open-api.vn/api/?depth=1");
            var callApiDistrict = (api) => {
                $("#province-is").val(
                    $(`#province option[value="${$("#province").val()}"]`).data("name")
                );
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response.districts, "district");
                    callApiWard(host + "d/" + $("#district").val() + "?depth=2");
                });
            };
            var callApiWard = (api) => {
                $("#district-is").val(
                    $(`#district option[value="${$("#district").val()}"]`).data("name")
                );
                return $.ajax({
                    url: api,
                    method: "GET",
                    dataType: "json"
                }).done(function(response) {
                    renderData(response.wards, "ward");
                    $("#ward-is").val(
                        $(`#ward option[value="${$("#ward").val()}"]`).data("name")
                    );
                });
            };

            var renderData = (array, select) => {
                let row = "";
                const postition = JSON.parse(localStorage.getItem("address"));

                array.forEach((element, index) => {
                    if (postition) {
                        row += `<option value="${element.code}" ${
            postition[select] && postition[select] == element.name ? "selected" : null
          } data-name="${element.name}">${element.name}</option>`;
                    } else {
                        row += `<option value="${element.code}" data-name="${element.name}">${element.name}</option>`;
                    }
                });
                $("#" + select).html(row);
            };

            $("#province").change(function() {
                callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
            });
            $("#district").change(function() {
                callApiWard(host + "d/" + $("#district").val() + "?depth=2");
            });
            $("#ward").change(function() {
                $("#ward-is").val($(`#ward option[value="${$("#ward").val()}"]`).data("name"));
            });
        }
        $("input").on('input', function() {
            $(this).siblings('.err-msg').html('')
        })
        $("textarea").on('input', function() {
            $(this).siblings('.err-msg').html('')
        })
        // các hàm validate form
        // các hàm validate form
        function checkIsEmpty(value) {
            return value.trim() == ''
        }

        function checkName(value, min = 0, max = 0) {
            value = value.trim();
            return value.length >= min && value.length <= max && /^([^0-9]*)$/.test(value)
        }

        function checkEmail(email) {
            return (/\S+@\S+\.\S+/.test(email.trim()))
        }

        function checkPhone(phone) {
            return /^[0]([0-9]){9,10}$/.test(phone);
        }
        // category
        $('#category-form').on('submit', function(e) {
            e.preventDefault()
            $(".title-err-msg").html('')
            if ($(this).find("#title").val() == '') {
                $(".title-err-msg").html('Chưa nhập tên danh mục...')
            } else {
                const formData = $(this).serialize()
                const action = $(this).attr('action')
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: `${action.includes('edit') ? 'Chỉnh sửa' : 'Thêm'} danh mục thành công`
                            })
                        } else {
                            $(".title-err-msg").html('Danh mục đã tồn tại...')
                        }
                    },
                });
            }
        })

        function deleteCategory(id) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Bạn có chắc muốn xóa danh mục này không ?'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/category/delete`,
                            data: {
                                id,
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateCategoryPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa danh mục thành công!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateCategoryPage(response) {
            const {
                categoryList
            } = JSON.parse(response)
            let categoriesHTML = ''
            for (const key in categoryList) {
                const {
                    categoryId,
                    title
                } = categoryList[key]
                categoriesHTML += `
                    <tr>
                                <td>${title}</td>
                                <td>
                                <?php
                                if ($this->checkRole('category-delete')) :
                                ?>
                                       <a class="btn btn-danger btn-custom" onclick="deleteCategory('${categoryId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('category-edit')) :
                                    ?>
                                       <a href="/admin/category/edit/${categoryId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                    `
            }
            $('.category-table-body').html(categoriesHTML)
        }
        // end category
        // -------user
        // sửa
        $('#user-form').on('submit', function(e) {
            e.preventDefault()
            let min = 2
            let max = 50
            let flag = true
            $(".err-msg").html('')
            const fname = $(this).find('#fname').val()
            const lname = $(this).find('#lname').val()
            const password = $(this).find('#password').val()
            const cfPass = $(this).find('#cfpass').val()
            if (checkIsEmpty(fname)) {
                $('.fname-err-msg').html('Chưa nhập họ...')
                flag = false
            } else if (!checkName(fname, min, max)) {
                $('.fname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }
            if (checkIsEmpty(lname)) {
                $('.lname-err-msg').html('Chưa nhập tên...')
                flag = false
            } else if (!checkName(lname, min, max)) {
                $('.lname-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }
            if (!checkEmail($(this).find('#email').val())) {
                $('.email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if (!checkPhone($(this).find('#phone').val())) {
                $('.phone-err-msg').html('Số điện thoại không hợp lệ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#street').val())) {
                $('.street-err-msg').html('Chưa nhập tên đường và số nhà...')
                flag = false
            }
            if (!checkIsEmpty(password) || !checkIsEmpty(cfPass)) {
                if (password.length < 6) {
                    $(".pass-err-msg").html('Mật khẩu tối thiểu 6 ký tự...')
                    flag = false
                }
                if (cfPass != password) {
                    $(".cfpass-err-msg").html('Nhập lại mật khẩu không khớp...')
                    flag = false
                }
            }
            console.log(flag);
            if (flag) {
                const formData = $(this).serialize()
                $.ajax({
                    type: 'POST',
                    url: '/admin/user/edit',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            const {
                                user
                            } = JSON.parse(response);
                            Swal.fire({
                                ...successPopup,
                                title: `Chỉnh sửa thành công 1 khách hàng`
                            })
                        } else {
                            Swal.fire({
                                ...successPopup,
                                icon: 'error',
                                title: `Email hoặc số điện thoại đã tồn tại`
                            })
                        }
                    },
                });
            }
        })
        // xóa
        function deleteUser(id) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Bạn có chắc muốn xóa khách hàng này không ?'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/user/delete`,
                            data: {
                                id,
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateUserPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa khách hàng thành công'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateUserPage(response) {
            const {
                users
            } = JSON.parse(response)
            let usersHTML = ''
            for (const key in users) {
                const {
                    userId,
                    fname,
                    lname,
                    email,
                    phone,
                    province,
                    district,
                    ward,
                    street
                } = users[key]
                usersHTML += `
                <tr>
                                <td><a href="/admin/user/detail/${userId}">${fname ? fname : ''} ${lname ? lname : ''}</a></td>
                                <td>${email}</td>
                                <td>${phone ? phone : ''}</td>
                                <td>
                                    <p style=" word-wrap: break-word;
                            white-space: normal;
                            overflow: hidden;
                            display: -webkit-box;
                            text-overflow: ellipsis;
                            -webkit-box-orient: vertical;
                            -webkit-line-clamp: 2;">
                                        ${street ? street : ''} - ${ward? ward : ''} - ${district ? district : ''} - ${province ? province : ''}
                                    </p>
                                </td>
                                <td>
                                <?php
                                if ($this->checkRole('user-detail')) :
                                ?>
                                        <a class="btn btn-success btn-custom" href="/admin/user/detail/${userId}"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('user-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteUser('${userId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('user-edit')) :
                                    ?>
                                        <a href="/admin/user/edit/${userId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    `
            }
            $('.user-table-body').html(usersHTML)
        }
        //----------end user
        // ---------order 
        // edit
        $('#order-form').on('submit', function(e) {
            e.preventDefault()
            let min = 2
            let max = 50
            let flag = true
            $(".receiver-err-msg").html('')
            $(".email-err-msg").html('')
            $(".phone-err-msg").html('')
            $(".street-err-msg").html('')
            const receiver = $(this).find('#receiver').val()
            const orderDate = $(this).find('#orderDate').val()
            if (checkIsEmpty(orderDate)) {
                $('.orderDate-err-msg').html('Vui lòng chọn ngày đặt hàng...')
                flag = false
            }
            if (checkIsEmpty(receiver)) {
                $('.receiver-err-msg').html('Chưa nhập họ...')
                flag = false
            } else if (!checkName(receiver, min, max)) {
                $('.receiver-err-msg').html(`Độ dài ${min} - ${max} ký tự, không chứa số...`)
                flag = false
            }
            if (!checkEmail($(this).find('#email').val())) {
                $('.email-err-msg').html('Email không hợp lệ...')
                flag = false
            }
            if (!checkPhone($(this).find('#phone').val())) {
                $('.phone-err-msg').html('Số điện thoại không hợp lệ...')
                flag = false
            }
            if (checkIsEmpty($(this).find('#street').val())) {
                $('.street-err-msg').html('Chưa nhập tên đường và số nhà...')
                flag = false
            }
            console.log(flag);
            if (flag) {
                const formData = $(this).serialize()
                $.ajax({
                    type: 'POST',
                    url: '/admin/order/edit',
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: `${action.includes('edit') ? 'Chỉnh sửa' : 'Thêm'} đơn hàng thành công`
                            })
                        }
                    },
                });
            }
        })
        // delete
        function deleteOrder(id) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Bạn có chắc muốn xóa đơn hàng này không'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/order/delete`,
                            data: {
                                id,
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateOrderPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa đơn hàng thành công !'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateOrderPage(response) {
            const {
                orders
            } = JSON.parse(response)
            let ordersHTML = ''
            for (const key in orders) {
                const {
                    orderId,
                    receiver,
                    email,
                    phone,
                    province,
                    district,
                    ward,
                    street,
                    summary,
                    orderDate
                } = orders[key]
                ordersHTML += `
                <tr>
                                <td><a href="/admin/order/detail/${orderId}">${orderId}</a></td>
                                <td>${orderDate}</td>
                                <td>${receiver}</td>
                                <td>${email}</td>
                                <td>${phone}</td>
                                <td>
                                    <p style=" word-wrap: break-word;
                                    white-space: normal;
                                    overflow: hidden;
                                    display: -webkit-box;
                                    text-overflow: ellipsis;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 2;">
                                        ${street} - ${ward} - ${district} - ${province}
                                    </p>
                                </td>
                                <td>${summary.toLocaleString('en-US', priceFormatOption)}đ</td>
                                <td>
                                <?php
                                if ($this->checkRole('order-detail')) :
                                ?>
                                        <a class="btn btn-success btn-custom" href="/admin/order/detail/${orderId}"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteOrder('${orderId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('order-edit')) :
                                    ?>
                                        <a href="/admin/order/edit/${orderId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    `
            }
            $('.order-table-body').html(ordersHTML)
        }
        // ---------end order 
        // ------------contact
        // edit
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
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: 'Phản hồi liên hệ thành công!'
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
        // delete
        function deleteContact(id) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Bạn có chắc muốn xóa liên hệ này không ?'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/contact/delete`,
                            data: {
                                id,
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateContactPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa liên hệ thành công!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateContactPage(response) {
            const {
                contacts
            } = JSON.parse(response)
            let ordersHTML = ''
            for (const key in contacts) {
                const {
                    id,
                    name,
                    userId,
                    email,
                    phone,
                    createdAt,
                    message,
                    reply
                } = contacts[key]
                ordersHTML += `
                <tr>
                                <td>${id}</td>
                                <td>${name}</td>
                                <td>${email}</td>
                                <td>${phone}</td>
                                <td>${createdAt}</td>
                                <td>
                                    <p style=" word-wrap: break-word;
                            white-space: normal;
                            overflow: hidden;
                            display: -webkit-box;
                            text-overflow: ellipsis;
                            -webkit-box-orient: vertical;
                            -webkit-line-clamp: 2;">
                                        ${message}
                                    </p>
                                </td>
                                <td>${reply ? '<i class="bi bi-check-circle-fill text-success"></i>': ''}</td>
                                <td>
                                <?php
                                if ($this->checkRole('contact-delete')) :
                                ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteContact('${id}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('contact-edit')) :
                                    ?>
                                        <a href="/admin/contact/reply/${id}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    `
            }
            $('.contact-table-body').html(ordersHTML)
        }
        // ------------end contact
        // -------------blog
        $('#blog-form').on('submit', function(e) {
            e.preventDefault()
            const action = $(this).attr('action')
            let min = 2
            let max = 50
            let flag = true
            $(".err-msg").html('')
            const name = $(this).find('#title').val().trim()
            const createdAt = $(this).find('#createdAt').val()

            if (!name) {
                $('.title-err-msg').html(`Chưa nhập tiêu đề...`)
                flag = false
            }
            if (tinymce.activeEditor.getContent().trim() === '') {
                $('.content-err-msg').html(`Chưa nhập nội dung tin tức...`)
                flag = false
            }
            if ($('#shortDesc').val().trim() == '') {
                $('.shortDesc-err-msg').html(`Chưa nhập mô tả nhắn cho tin tức...`)
                flag = false
            }
            if (action.includes('edit')) {
                if (!createdAt) {
                    $('.createAt-err-msg').html(`Chưa chọn ngày tạo tin tức...`)
                    flag = false
                }
            }
            if (flag) {
                var formData = new FormData();
                formData.append('title', name);
                formData.append('thumbnail', $('#thumbnail')[0].files[0]);
                formData.append('author', $('#select-box').val());
                formData.append('content', tinymce.activeEditor.getContent());
                formData.append('shortDesc', $('#shortDesc').val().trim());
                if ($(this).find('#createdAt').length > 0) {
                    formData.append('createdAt', $(this).find('#createdAt').val());
                }
                if ($(this).find('#id').length > 0) {
                    formData.append('id', $(this).find('#id').val());
                }
                const action = $(this).attr('action')
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: `${action.includes('edit') ? 'Chỉnh sửa' : 'Thêm'} tin tức thành công`
                            })

                        } else {
                            $('.thumbnail-err-msg').html(JSON.parse(response).uploadErr)
                        }
                    },
                });
            }
        })

        function deleteBlog(id) {
            if (id) {
                Swal.fire(confirmPopup).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/blog/delete`,
                            data: {
                                id,
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    if (window.location.pathname == '/admin/blog') {
                                        updateBlogPage(response)
                                        Swal.fire({
                                            ...successPopup,
                                            title: 'Delete blog successfully!',
                                        })
                                    } else {
                                        window.location = '/admin/blog'
                                    }
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateBlogPage(response) {
            const {
                blogs
            } = JSON.parse(response)
            let ordersHTML = ''
            for (const key in blogs) {
                const {
                    blogId,
                    title,
                    thumbnail,
                    createdAt,
                    content,
                    author,
                    shortDesc,
                    isShown
                } = blogs[key]
                ordersHTML += `
                <tr>
                                <td><img src="<?= _WEB_ROOT ?>/public/assets/images/blog/${thumbnail}" style="width: 50px"/></td>
                                <td>${title}</td>
                                <td>${author}</td>
                                <td>${createdAt}</td>
                                <td>
                                    <p style=" word-wrap: break-word;
                            white-space: normal;
                            overflow: hidden;
                            display: -webkit-box;
                            text-overflow: ellipsis;
                            -webkit-box-orient: vertical;
                            -webkit-line-clamp: 2;">
                           ${shortDesc ? shortDesc : ''}
                                    </p>
                                </td>
                                <td>
                                <?php
                                if ($this->checkRole('blog-toggle')) :
                                ?>
                                        <a class="btn btn-primary btn-custom" onclick="toggleShowHide('${blogId}','${isShown}');" href="javascript:void(0)"><i class="bi ${isShown == 1 ? 'bi-eye-slash' : 'bi-eye'}"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-detail')) :

                                    ?>
                                        <a class="btn btn-success btn-custom" href="/admin/blog/detail/${blogId}"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteBlog('${blogId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('blog-edit')) :
                                    ?>
                                        <a href="/admin/blog/edit/${blogId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    `
            }
            $('.blog-table-body').html(ordersHTML)
        }

        function toggleShowHide(id, show) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: `${show == 0 ? 'Hiện' : 'ẩn'} tin tức này ?`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/blog/toggle`,
                            data: {
                                id,
                                show: show == 1 ? 0 : 1
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateBlogPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: `${show == 0 ? 'Hiện' : 'ẩn'} tin tức thành công!`,
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }
        // -------------end blog
        //  ----------- product
        function deleteImage(id, productId) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: 'Xóa 1 ảnh của sản phẩm hiện tại?',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/product/deleteImage`,
                            data: {
                                id,
                                productId
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    // call fnc
                                    updateImageList(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa thành công 1 ảnh sản phẩm!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }

        function updateImageList(response) {
            const {
                images
            } = JSON.parse(response)
            let imgsHTML = ''
            for (const key in images) {
                const {
                    imgId,
                    productId,
                    image
                } = images[key]
                imgsHTML += `
                <span style="width: 20%; min-width: 200px" class="position-relative d-inline-block">
                <?php
                if ($this->checkRole('product-deleteImage')) :
                ?>
                                        <button onclick="deleteImage('${imgId}', '${productId}')" class="btn btn-custom btn-danger position-absolute" style="right: 0;"><i class="bi bi-x"></i></button>
                                    <?php endif; ?>
                                    
                                    <img src="/public/assets/images/products/${image}" class="w-100">
                                </span>
                    `
            }
            $('.imgs').html(imgsHTML)
        }

        function deleteOption(id, productId) {
            console.log(productId, id);
            if (id) {
                Swal.fire(confirmPopup).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/product/deleteOption`,
                            data: {
                                id,
                                productId
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    // call fnc
                                    updateOptionTable(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: 'Xóa thuộc tính thành công!'
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }
        $('#option-form').on('submit', function(e) {
            e.preventDefault();
            $('err-msg').html('')
            let flag = true
            if ($(this).find('#quantity').val() == '' || isNaN($(this).find('#quantity').val())) {
                flag = false
                $('.quantity-err-msg').html('Số lượng không hợp lệ...')
            }
            let formData = $(this).serializeArray()
            const action = $(this).attr('action')
            if (flag) {
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    success: function(response) {
                        if (response) {
                            if (JSON.parse(response).status == 1) {
                                Swal.fire({
                                    ...successPopup,
                                    title: `${action.includes('edit') ? 'Chỉnh sửa' : 'Thêm'} thuộc tính thành công`,
                                })
                            }
                            if (JSON.parse(response).errMsg) {
                                $('.existed-err-msg').html(JSON.parse(response).errMsg)
                            }
                        }
                    },
                });
            }
        })

        function updateOptionTable(response) {
            const {
                options
            } = JSON.parse(response)
            let optionsHTML = ''
            for (const key in options) {
                const {
                    productId,
                    optionId,
                    color,
                    size,
                    quantity
                } = options[key]
                optionsHTML += `
                <tr>
                                <td><span class="d-block" style="width: 30px; height: 30px; background-color: ${color}; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 0 3px #000"></span></td>
                                <td>${size}</td>
                                <td>${quantity}</td>
                                <td>
                                <?php
                                if ($this->checkRole('product-deleteOption')) :
                                ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteOption('${optionId}','${productId}');" href="javascript:void(0)">Xóa lựa chọn<i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-editOption')) :
                                    ?>
                                       <a href="/admin/product/editOptions/${optionId}" class="btn btn-warning btn-custom">Chỉnh sửa lựa chọn<i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                    `
            }
            $('.options').html(optionsHTML)
        }
        $('#images-form').on('submit', function(e) {
            e.preventDefault()
            if ($('#images')[0].files.length > 0) {
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '/admin/product/uploadProductImages',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            updateImageList(response)
                            Swal.fire({
                                ...successPopup,
                                title: 'Tải hình ảnh thành công!'
                            })
                        } else {
                            $('.file-err-msg').html(JSON.parse(response).uploadErr)
                        }
                    },
                });
            } else {
                $('.file-err-msg').html('Please choose a file')
            }
        })
        $('#product-form').on('submit', function(e) {
            e.preventDefault()
            let flag = true
            let salePercent = $('#salePercent').val()
            let originalPrice = $('#originalPrice').val()
            $('err-msg').html('')
            if ($('#title').val().trim() == '') {
                $('.title-err-msg').html('Chưa nhập tên sản phẩm')
                flag = false
            }
            if (originalPrice.trim() == '' || isNaN(originalPrice)) {
                $('.originalPrice-err-msg').html('Chưa nhập giá hoặc nhập không hợp lệ')
                flag = false
            }
            if (salePercent.trim() == '' || isNaN(salePercent)) {
                $('.salePercent-err-msg').html('Chưa nhập giảm giá hoặc nhập không hợp lệ')
                flag = false
            }
            if ($('#desc').val().trim() == '') {
                $('.desc-err-msg').html('Chưa nhập mô tả sản phẩm')
                flag = false
            }
            if (flag) {
                var formData = $(this).serializeArray()
                var action = $(this).attr('action')
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    success: function(response) {
                        if (response && JSON.parse(response).status == 1) {
                            Swal.fire({
                                ...successPopup,
                                title: `${ action.includes('/edit') ? 'Chỉnh sửa': 'Thêm'}  sản phẩm thành công!`
                            })
                        } else {
                            $('.existed-err-msg').html(JSON.parse(response).errMsg)
                        }
                    },
                });
            }
        })

        function deleteProduct(id) {
            if (id) {
                Swal.fire(confirmPopup).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/product/delete`,
                            data: {
                                id
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    if (window.location.pathname == '/admin/product') {
                                        updateProductPage(response)
                                        Swal.fire({
                                            ...successPopup,
                                            title: 'Sản phẩm đã được xóa!'
                                        })
                                    } else {
                                        window.location = '/admin/product'
                                    }

                                }
                            },
                        });
                    }
                })
            }
        }

        function updateProductPage(response) {
            const {
                products
            } = JSON.parse(response)
            let productsHTML = ''
            for (const key in products) {
                const {
                    productId,
                    image,
                    title,
                    originalPrice,
                    salePercent,
                    currentPrice,
                    sold,
                    isShown
                } = products[key]
                productsHTML += `
                <tr>
                                <td><img src="/public/assets/images/products/${image ? image : ''}" style="width: 50px" alt=""></td>
                                                            <td style="max-width: 200px;">
                                                                <p style=" word-wrap: break-word;
                                white-space: normal;
                                overflow: hidden;
                                display: -webkit-box;
                                text-overflow: ellipsis;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 2; ">${title}</p>
                                </td>
                                <td>${originalPrice.toLocaleString('en-US', priceFormatOption)}đ</td>
                                <td>${salePercent}</td>
                                <td>${currentPrice.toLocaleString('en-US', priceFormatOption)}đ</td>
                                <td>${sold}</td>
                                <td>
                                <?php
                                if ($this->checkRole('product-toggle')) :
                                ?>
                                        <a class="btn btn-primary btn-custom" onclick="toggleShowHideProduct('${productId}','${isShown}');" href="javascript:void(0)"><i class="bi ${isShown == 1 ? 'bi-eye-slash' : 'bi-eye'}"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-detail')) :
                                    ?>
                                        <a class="btn btn-success btn-custom" href="/admin/product/detail/${productId}"><i class="bi bi-list-task"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-delete')) :
                                    ?>
                                        <a class="btn btn-danger btn-custom" onclick="deleteProduct('${productId}');" href="javascript:void(0)"><i class="bi bi-trash"></i></a>
                                    <?php endif; ?>
                                    <?php
                                    if ($this->checkRole('product-edit')) :
                                    ?>
                                        <a href="/admin/product/edit/${productId}" class="btn btn-warning btn-custom"><i class="bi bi-pen"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>   
                    `
            }
            let len = Object.keys(products).length
            $('.dataTable-info').html(`Đang hiển thị 1 đến ${$('.dataTable-selector').val() > len ? len : $('.dataTable-selector').val()} trong số ${len} kết quả tìm thấy`)
            $('.product-table-body').html(productsHTML)
        }

        function toggleShowHideProduct(id, show) {
            if (id) {
                Swal.fire({
                    ...confirmPopup,
                    title: `${show == 0 ? 'Hiện' : 'Ẩn'} sản phẩm này ?`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `/admin/product/toggle`,
                            data: {
                                id,
                                show: show == 1 ? 0 : 1
                            },
                            success: function(response) {
                                if (response && JSON.parse(response).status == 1) {
                                    updateProductPage(response)
                                    Swal.fire({
                                        ...successPopup,
                                        title: `${show == 0 ? 'Hiện' : 'Ẩn'} sản phẩm thành công!`,
                                    })
                                }
                            },
                        });
                    }
                })
            }
        }
        // ------------end product
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
                            Swal.fire({
                                ...successPopup,
                                title: 'Chỉnh sửa đánh giá thành công!'
                            })
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
            if (!checkEmail($('#email').val())) {
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
                            Swal.fire({
                                ...successPopup,
                                title: `${action.includes('edit') ? 'Chỉnh sửa' : 'Thêm'} nhân viên thành công`
                            })

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
                            title: 'Phân quyền thành công!'
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
                                    <td colspan='2' class="text-center">Tổng ${typeReport == 1 ? "số lượng: " : 'doanh thu: '}<b>${summary}đ</b></td></tr>
                                    </tbody>
                                `)
                            }
                        }
                    },
                });
            }

        })
        // --------------------end statistics
    </script>
</body>

</html>
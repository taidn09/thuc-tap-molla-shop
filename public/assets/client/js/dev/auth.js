$(".register-form").on("submit", function (event) {
  event.preventDefault();
  var formData = $(this).serialize();
  let flag = true;
  $(".res-email-err-msg").html("");
  $(".res-pass-err-msg").html("");
  if ($(this)[0][0].value.trim() == "") {
    $(".res-email-err-msg").html("Vui lòng nhập email...");
    flag = false;
  } else if (!/\S+@\S+\.\S+/.test($(this)[0][0].value)) {
    $(".res-email-err-msg").html("Email không hợp lệ...");
    flag = false;
  }
  if ($(this)[0][1].value.trim().length < 6) {
    $(".res-pass-err-msg").html("Mật khẩu tối thiểu 6 ký tự...");
    flag = false;
  }
  if ($(this)[0][1].value != $(this)[0][2].value) {
    $(".res-cfpass-err-msg").html("Mật khẩu nhập lại không trùng khớp...");
    flag = false;
  }
  if (flag) {
    $.ajax({
      type: "POST",
      url: "/auth/register",
      data: formData,
      success: function (response) {
        if (response == 1) {
          Swal.fire({
            ...successPopup,
            title: "Đăng ký thành công",
          });
          $("#signin-2").addClass("show active");
          $("#signin-tab-2").addClass("active");
          $("#register-2").removeClass("show active");
          $("#register-tab-2").removeClass("active");
        } else {
          $(".res-email-err-msg").html("Email đã tồn tại...");
        }
      },
    });
  }
});
$(".login-form").on("submit", function (event) {
  event.preventDefault();
  var formData = $(this).serialize();
  let flag = true;
  $(".login-email-err-msg").html("");
  $(".login-pass-err-msg").html("");
  if ($(this)[0][0].value.trim() == "") {
    $(".login-email-err-msg").html("Vui lòng nhập email...");
    flag = false;
  }
  if ($(this)[0][1].value.trim() == "") {
    $(".login-pass-err-msg").html("Vui lòng nhập mật khẩu...");
    flag = false;
  }
  if (flag) {
    $.ajax({
      type: "POST",
      url: "/auth/login",
      data: formData,
      success: function (response) {
        response = JSON.parse(response);
        if (typeof response == "object") {
          window.location = "/";
        } else {
          Swal.fire({
            ...successPopup,
            icon: "error",
            title: "Email hoặc mật khẩu không chính xác!",
          });
        }
      },
    });
  }
});

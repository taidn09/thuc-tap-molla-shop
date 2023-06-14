const confirmPopup = {
  title: "Bạn có chắc muốn xóa bản ghi này không?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Vâng, đồng ý!",
  cancelButtonText: "Đóng!",
};
const successPopup = {
  position: "center",
  icon: "success",
  showConfirmButton: false,
  timer: 1500,
};
const priceFormatOption = {
  useGrouping: true,
  maximumFractionDigits: 0,
};
function checkAdminRoleValid(status){
  if(status === 2){
    window.location = '/admin/401'
  }
}
$("input").on("input", function () {
  $(this).siblings(".err-msg").html("");
});
$("input[type=password]").on("input", function () {
  $(this).parent().siblings(".err-msg").html("");
});
$("textarea").on("input", function () {
  $(this).siblings(".err-msg").html("");
});
$(document).on("click", ".toggle-password", function () {
  if ($(this).next("input").attr("type") == "password") {
    $(this).next("input").attr("type", "text");
    $(this).removeClass("bi-eye-slash-fill");
    $(this).addClass("bi-eye-fill");
  } else {
    $(this).next("input").attr("type", "password");
    $(this).addClass("bi-eye-slash-fill");
    $(this).removeClass("bi-eye-fill");
  }
});

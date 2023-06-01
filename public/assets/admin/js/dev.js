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

$("input").on("input", function () {
  $(this).siblings(".err-msg").html("");
});
$("textarea").on("input", function () {
  $(this).siblings(".err-msg").html("");
});

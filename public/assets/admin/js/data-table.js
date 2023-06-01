$(document).ready(function () {
  $(".datatable").DataTable({
    language: {
      sProcessing: "Đang xử lý...",
      sLengthMenu: "Hiển thị _MENU_",
      sZeroRecords: "Không tìm thấy kết quả nào phù hợp",
      sInfo: "Đang hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng",
      sInfoEmpty: "Đang hiển thị từ 0 đến 0 trong tổng số 0 dòng",
      sInfoFiltered: "(được lọc từ tổng số _MAX_ mục)",
      sSearch: "Tìm kiếm:",
      oPaginate: {
        sFirst: "Đầu",
        sLast: "Cuối",
        sNext: "Trang sau",
        sPrevious: "Trang trước",
      },
      oAria: {
        sSortAscending: ": Sắp xếp cột theo thứ tự tăng dần",
        sSortDescending: ": Sắp xếp cột theo thứ tự giảm dần",
      },
    },
    columnDefs: [
      {
        orderable: false,
        targets: -1,
      },
    ],
  });
});

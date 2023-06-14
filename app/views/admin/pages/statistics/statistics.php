<main id="main" class="main">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Thống kê</h5>
                <div>
                    <div class="alert alert-danger text-center err-msg d-none"></div>
                    <form action="/admin/statistics" method="post" id="report-form" class="d-flex gap-2 my-3">
                        <select name="typeDisplay" class="form-select" style="width: fit-content">
                            <option value="1" <?= (!empty($_POST['typeDisplay']) && $_POST['typeDisplay'] == '1') ? 'selected' : '' ?>>Bảng</option>
                            <option value="2" <?= (!empty($_POST['typeDisplay']) && $_POST['typeDisplay'] == '2') ? 'selected' : '' ?>>Biểu đồ</option>
                        </select>
                        <select name="typeReport" class="form-select" style="width: fit-content">
                            <option value="1" <?= (!empty($_POST['typeReport']) && $_POST['typeReport'] == '1') ? 'selected' : '' ?>>Số lượng bán</option>
                            <option value="2" <?= (!empty($_POST['typeReport']) && $_POST['typeReport'] == '2') ? 'selected' : '' ?>>Doanh thu</option>
                        </select>
                        <select name="filter" id="filter" class="form-select" style="width: fit-content;">
                            <option value="day" <?= (!empty($_POST['filter']) && $_POST['filter'] == 'day') ? 'selected' : '' ?>>Trong ngày</option>
                            <option value="week" <?= (!empty($_POST['filter']) && $_POST['filter'] == 'week') ? 'selected' : '' ?>>Trong tuần</option>
                            <option value="month" <?= (!empty($_POST['filter']) && $_POST['filter'] == 'month') ? 'selected' : '' ?>>Trong tháng</option>
                            <option value="range" <?= (!empty($_POST['filter']) && $_POST['filter'] == 'range') ? 'selected' : '' ?>>Trong khoảng</option>
                        </select>

                        <input type="date" name="date" id="date" class="form-control input-after-choose <?= (!empty($_POST['filter']) && $_POST['filter'] == 'day') || empty($_POST['filter']) ? '' : 'd-none' ?>" value="<?= (!empty($_POST['date'])) ? $_POST['date'] : '' ?>">
                        <input type="week" name="week" id="week" class="form-control input-after-choose <?= (!empty($_POST['filter']) && $_POST['filter'] == 'week') ? '' : 'd-none' ?>" value="<?= (!empty($_POST['week'])) ? $_POST['week'] : '' ?>">
                        <input type="month" name="month" id="month" class="form-control input-after-choose <?= (!empty($_POST['filter']) && $_POST['filter'] == 'month') ? '' : 'd-none' ?>" value="<?= (!empty($_POST['month'])) ? $_POST['month'] : '' ?>">
                        <input type="date" name="from" id="from" class="form-control input-after-choose <?= (!empty($_POST['filter']) && $_POST['filter'] == 'range') ? '' : 'd-none' ?>" style="max-width: 300px" value="<?= (!empty($_POST['from'])) ? $_POST['from'] : '' ?>">
                        <input type="date" name="to" id="to" class="form-control input-after-choose <?= (!empty($_POST['filter']) && $_POST['filter'] == 'range') ? '' : 'd-none' ?>" style="max-width: 300px" value="<?= (!empty($_POST['filter'])) ? $_POST['to'] : '' ?>">
                        <button type="submit" class="btn btn-custom btn-primary" style="min-width: 200px">Thống kê</button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Pie Chart -->
                                <table class="d-none ui celled table table-bordered" id="display-type-table">
                                </table>
                                <div id="pieChart" style="min-height: 400px;" class="echart mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- End Recent Sales -->
</main>
<script>
    const filterSelect = document.getElementById("filter");
    const dateInput = document.getElementById("date");
    const weekInput = document.getElementById("week");
    const monthInput = document.getElementById("month");
    const fromInput = document.getElementById("from");
    const toInput = document.getElementById("to");

    filterSelect.addEventListener("change", function() {
        const selectedValue = filterSelect.value;

        // hide all input elements
        dateInput.classList.add("d-none");
        weekInput.classList.add("d-none");
        monthInput.classList.add("d-none");
        fromInput.classList.add("d-none");
        toInput.classList.add("d-none");

        // show the input element based on the selected option
        if (selectedValue === "day") {
            dateInput.classList.remove("d-none");
        } else if (selectedValue === "week") {
            weekInput.classList.remove("d-none");
        } else if (selectedValue === "month") {
            monthInput.classList.remove("d-none");
        } else if (selectedValue === "range") {
            fromInput.classList.remove("d-none");
            toInput.classList.remove("d-none");
        }
    });
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
                                    text: `Thống kê theo ${typeReport == 1 ? 'số lượng bán ra' :
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
                                    fontFamily: 'Space Grotesk'
                                },
                                series: [{
                                    name: 'Danh sách sản phẩm',
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
</script>
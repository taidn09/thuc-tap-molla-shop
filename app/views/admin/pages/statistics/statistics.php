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
</script>
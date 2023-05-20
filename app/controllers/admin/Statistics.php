<?php
class Statistics extends Controller
{
    public $data = [];
    private $model = null;
    public function __construct()
    {
        $this->model = new StatisticsModel();
    }
    public function index()
    {
        if (!empty($_POST)) {
            if ($_POST['filter'] == 'day') {
                if (!empty($_POST['date'])) {
                    $day = explode('-', $_POST['date'])[2];
                    $month = explode('-', $_POST['date'])[1];
                    $year = explode('-', $_POST['date'])[0];
                    $result = $this->model->ReportByDay($day, $month, $year, $_POST['typeReport']);
                    echo json_encode([
                        'result' => $result,
                        'status' => 1
                    ]);
                }
            } elseif ($_POST['filter'] == 'month') {
                if (!empty($_POST['month'])) {
                    $month = explode('-', $_POST['month'])[1];
                    $year = explode('-', $_POST['month'])[0];
                    $result = $this->model->ReportByMonth($month, $year, $_POST['typeReport']);
                    echo json_encode([
                        'result' => $result,
                        'status' => 1
                    ]);
                }
            } elseif ($_POST['filter'] == 'quarter') {
            } elseif ($_POST['filter'] == 'week') {
                if (!empty($_POST['week'])) {
                    $week = $_POST['week'];
                    $result = $this->model->ReportByWeek($week, $_POST['typeReport']);
                    echo json_encode([
                        'result' => $result,
                        'status' => 1
                    ]);
                }
            } elseif ($_POST['filter'] == 'range') {
                if (!empty($_POST['from']) && !empty($_POST['to'])) {
                    $date_str_1 = $_POST['from'];  // Replace with the name of your first input field
                    $date_str_2 = $_POST['to'];  // Replace with the name of your second input field
                    $result = $this->model->ReportFormTo($date_str_1, $date_str_2, $_POST['typeReport']);
                    echo json_encode([
                        'result' => $result,
                        'status' => 1
                    ]);
                }
            }
        } else {
            $this->data['subcontent']['controller'] = 'statistics';
            $this->data['content'] = 'admin/pages/statistics/statistics';
            $this->render('layouts/admin', $this->data);
        }
    }
}

<?php
class StatisticsModel
{
    private $db = null;
    public function __construct()
    {
        $this->db = new Connection();
    }
    public function ReportByMonth($month, $year, $type = 1)
    {
        if ($type == 1) {
            $select = "SELECT a.title, SUM(b.quantity) as soldQty, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId and month(orderDate) = $month and year(orderDate) = $year GROUP BY a.title";
        } else {
            $select = "SELECT a.title, SUM(b.total) as total, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId and month(orderDate) = $month and year(orderDate) = $year GROUP BY a.title";
        }
        return $this->db->getAll($select);
    }
    public function ReportByDay($day, $month, $year, $type = 1)
    {
        if ($type == 1) {
            $select = "SELECT a.title, SUM(b.quantity) as soldQty, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId and day(orderDate) = $day and month(orderDate) = $month and year(orderDate) = $year GROUP BY a.title";
        } else {
            $select = "SELECT a.title, SUM(b.total) as total, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId and day(orderDate) = $day and month(orderDate) = $month and year(orderDate) = $year GROUP BY a.title";
        }
        return $this->db->getAll($select);
    }
    public function ReportByQuarter($quarter, $year, $type = 1)
    {
        $startDate = '';
        $endDate = '';
        switch ($quarter) {
            case 1:
                $startDate = $year . '-01-01';
                $endDate = $year . '-03-31';
                break;
            case 2:
                $startDate = $year . '-04-01';
                $endDate = $year . '-06-30';
                break;
            case 3:
                $startDate = $year . '-07-01';
                $endDate = $year . '-09-30';
                break;
            case 4:
                $startDate = $year . '-10-01';
                $endDate = $year . '-12-31';
                break;
            default:
                return null;
        }
        return $this->ReportFormTo($startDate, $endDate, $type);
    }
    public function ReportByWeek($postedValue, $type = 1)
    {
        list($year, $week_quantity) = explode('-W', $postedValue);
        $timestamp_first_day = strtotime($year . 'W' . $week_quantity . '1');

        $timestamp_last_day = strtotime($year . 'W' . $week_quantity . '7');
        $first_day_of_week = date('Y-m-d', $timestamp_first_day);
        $last_day_of_week = date('Y-m-d', $timestamp_last_day);
        return $this->ReportFormTo($first_day_of_week, $last_day_of_week, $type);
    }
    public function ReportFormTo($startDate, $endDate, $type = 1)
    {
        // c.orderDate >= '$startDate' AND c.orderDate <= '$endDate
        if ($type == 1) {
            $select = "SELECT a.title, SUM(b.quantity) as soldQty, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId AND c.orderDate >= '$startDate' AND c.orderDate <= '$endDate' GROUP BY a.title";
        } else {
            $select = "SELECT a.title, SUM(b.total) as total, d.size, d.color FROM products as a, order_details as b, orders as c, product_options as d WHERE a.productId = b.productId and c.orderId = b.orderId AND d.optionId = b.optionId AND c.orderDate >= '$startDate' AND c.orderDate <= '$endDate' GROUP BY a.title";
        }
        return $this->db->getAll($select);
    }
}

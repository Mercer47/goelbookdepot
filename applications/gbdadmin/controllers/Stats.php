<?php


class Stats extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StatsModel');
    }

    public function index()
    {
        $startDate = date("Y-m-d", strtotime('-7 days'));
        $endDate = date("Y-m-d");
        $data['orderData'] = $this->StatsModel->getOrderStats($startDate, $endDate);
        $data['customerData'] = $this->StatsModel->getCustomerData($startDate, $endDate);
        $data['salesData'] = $this->StatsModel->getSalesData($startDate, $endDate);
        $this->load->view('stats/view', $data);
    }

    public function getData()
    {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $orderData = $this->StatsModel->getOrderStats($startDate, $endDate);
        $customerData = $this->StatsModel->getCustomerData($startDate, $endDate);
        $salesData = $this->StatsModel->getSalesData($startDate, $endDate);

        $response['orderData'] = $orderData;
        $response['customerData'] = $customerData;
        $response['salesData'] = $salesData;

        print_r(json_encode($response));
    }
}
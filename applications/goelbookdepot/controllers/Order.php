<?php


class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->config->load('credentials');
    }


    public function status($status)
    {
        if (!is_null($status) && isset($_GET['message'])) {
            $data['status'] = $status;
            $data['message'] = $_GET['message'];
            $this->load->view('orders/status',$data);
        } else {
            redirect(site_url('home'));
        }

    }

    public function verify()
    {
        $response = $this->input->post('response');
        $orderId = $this->input->post('orderId');
        $generatedSignature = hash_hmac('sha256', $orderId."|".$response['razorpay_payment_id'], $this->config->item('RAZORPAY_SECRET'));
        if ($generatedSignature === $response['razorpay_signature']) {
            $this->OrderModel->updateOrder($response);
            http_response_code('200');
        } else {
            http_response_code('400');
        }
    }
}
<?php


class Order extends CI_Controller
{
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
}
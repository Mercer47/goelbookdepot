<?php


class Order extends CI_Controller
{
    public function status($status, $message)
    {
        if (!is_null($status)) {
            $data['status'] = $status;
            $data['message'] = $message;
            $this->load->view('orders/status',$data);
        } else {
            redirect(site_url('home'));
        }

    }
}
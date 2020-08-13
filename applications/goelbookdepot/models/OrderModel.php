<?php


class OrderModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function updateOrder($response)
    {
        $this->db->set('Status', 'Payment Successful');
        $this->db->where('razorpay_order_id', $response['razorpay_order_id']);
        return $this->db->update('orders');
    }
}
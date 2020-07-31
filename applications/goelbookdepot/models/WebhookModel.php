<?php


class WebhookModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function handlePaymentIntentSucceeded($paymentIntent){
        $data=array(
            'Status' => 'Success'
        );
        $this->db->where('intent_id',$paymentIntent->id);
        $this->db->update('orders', $data);
        return $this->db->get_where('orders', array('intent_id' => $paymentIntent->id) )->first_row();
    }

    public function handlePaymentMethodAttached($paymentMethod)
    {

    }

    public function handlePaymentIntentProcessing($paymentIntent)
    {
        $data=array(
            'Status' => 'Processing'
        );
        $this->db->where('intent_id',$paymentIntent->id);
        $this->db->update('orders',$data);
    }

    public function handlePaymentIntentFailed($paymentIntent)
    {
        $data = array(
            'Status' => 'Failed'
        );
        $this->db->where('intent_id',$paymentIntent->id);
        $this->db->update('orders',$data);
        return $this->db->get_where('orders', array('intent_id' => $paymentIntent->id) )->first_row();
    }

    public function handlePaymentIntentCanceled($paymentIntent)
    {
        $data = array(
            'Status' => 'Canceled'
        );
        $this->db->where('intent_id',$paymentIntent->id);
        $this->db->update('orders',$data);
    }
}
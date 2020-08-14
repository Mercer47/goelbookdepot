<?php


class WebhookModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function updateOrder($message)
    {
        switch($message->event) {
            case 'payment.authorized':
                $status = 'Verifying Payment';
                break;

            case 'payment.captured':
                $status = 'Payment Successfool';
                break;

            case 'payment.failed':
                $status = 'Payment Failed';
                break;

            default:
                $status = 'Unknown';
                break;
        }

        $this->db->set('Status', $status);
        $this->db->where('razorpay_order_id', $message->payload->payment->entity->order_id);
        $this->db->update('orders');
        return $this->db->get_where(
            'orders',
            array('razorpay_order_id' => $message->payload->payment->entity->order_id)
        )->first_row();
    }
}
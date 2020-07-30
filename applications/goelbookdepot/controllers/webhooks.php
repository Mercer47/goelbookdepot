<?php


class webhooks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index(){
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51H3hLRE7tUzyZRD9bnguSMUNiPQ8rbEJy3OTdgem4Hs892xkH3N1IfTzqCWyLfpVIbluIgrSSnhb7840obP0uEyy003JnvFmLD');

        // If you are testing your webhook locally with the Stripe CLI you
        // can find the endpoint's secret by running `stripe listen`
        // Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
        $endpoint_secret = 'whsec_Ak3JwsqjVZqiLBxrUegUjccUHO6fTLVy';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

    // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a StripePaymentIntent
                $this->handlePaymentIntentSucceeded($paymentIntent);
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a StripePaymentMethod
                $this->handlePaymentMethodAttached($paymentMethod);
                break;
            case 'payment_intent.processing';
                $paymentIntent = $event->data->object;
                $this->handlePaymentIntentProcessing($paymentIntent);
                break;
            case 'payment_intent.payment_failed';
                $paymentIntent = $event->data->object;
                $this->handlePaymentIntentFailed($paymentIntent);
                break;
            case 'payment_intent.canceled';
                $paymentIntent = $event->data->object;
                $this->handlePaymentIntentCanceled($paymentIntent);
                break;
            default:
                // Unexpected event type
                http_response_code(400);
                exit();
        }

        http_response_code(200);
    }

    function handlePaymentIntentSucceeded($paymentIntent){
        $data=array(
            'Status' => 'Success'
        );
        $this->db->where('intent_id',$paymentIntent->id);
        $this->db->update('orders',$data);
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
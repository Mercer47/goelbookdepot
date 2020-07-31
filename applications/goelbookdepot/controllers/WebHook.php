<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class WebHook extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('WebHookModel');
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
                $order = $this->WebHookModel->handlePaymentIntentSucceeded($paymentIntent);
                if ($order) {
                    $subject = 'Order Confirmed';
                    $message = 'Dear '.$order->Name.', <br/> Thanks for buying books from Goel Book Depot. 
                                <br/>You will be notified when your Order will be shipped.
                                <br/>You can also check your order Status in "My Orders" section after Signing in to Goel Book Depot App
                                <br/>Have a Nice Day
                                <br/><br/>With Regards,
                                <br/>Goel Book Depot';
                    $mailParams = [
                        'order' => $order,
                        'subject' => $subject,
                        'message' => $message,
                    ];
                    $this->sendConfirmationMail($mailParams);
                }
                break;
            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a StripePaymentMethod
                $this->WebHookModel->handlePaymentMethodAttached($paymentMethod);
                break;
            case 'payment_intent.processing';
                $paymentIntent = $event->data->object;
                $this->WebHookModel->handlePaymentIntentProcessing($paymentIntent);
                break;
            case 'payment_intent.payment_failed';
                $paymentIntent = $event->data->object;
                $order = $this->WebHookModel->handlePaymentIntentFailed($paymentIntent);
                if ($order) {
                    $subject = 'Order Failed';
                    $message = 'Dear '.$order->Name.', <br/> Thank You for placing an order on Goel Book Depot . 
                                <br/>You recently placed an order but the order was failed.
                                <br/>It may be due to problems in your bank server. Please try to place order again after sometime.
                                <br/>Have a Nice Day.
                                <br/><br/>With Regards,
                                <br/>Goel Book Depot';
                    $mailParams = [
                        'order' => $order,
                        'subject' => $subject,
                        'message' => $message,
                    ];
                    $this->sendConfirmationMail($mailParams);
                }
                break;
            case 'payment_intent.canceled';
                $paymentIntent = $event->data->object;
                $this->WebHookModel->handlePaymentIntentCanceled($paymentIntent);
                break;
            default:
                // Unexpected event type
                http_response_code(400);
                exit();
        }
        http_response_code(200);
    }

    public function sendConfirmationMail($mailParams)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'raghavkumakshay@gmail.com';                     // SMTP username
            $mail->Password   = 'cozjfgsrazukqjls';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('raghavkumakshay@gmail.com', 'GBD');
            $mail->addAddress($mailParams['order']->Email, $mailParams['order']->Name);     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            // Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $mailParams['subject'];
            $mail->Body    = $mailParams['message'];
//            $mail->AltBody = 'The link for your password reset is '.$link;

            $mail->send();
            //
        } catch (Exception $e) {
            //
        }
    }
}
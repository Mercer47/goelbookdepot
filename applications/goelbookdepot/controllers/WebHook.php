<?php

use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class WebHook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('WebhookModel');
        $this->config->load('credentials');
    }

    public function index()
    {
        $api = new Api($this->config->item('RAZORPAY_API'), $this->config->item('RAZORPAY_SECRET'));
        $signature = $this->input->get_request_header('X-Razorpay-Signature', TRUE);
        $message = $this->input->raw_input_stream;
        $secret = $this->config->item('RAZORPAY_WEBHOOK_SECRET');
        $expected_signature = hash_hmac('sha256', $message, $secret);
        if ($expected_signature === $signature) {
            $this->WebhookModel->updateOrder($message);
        } else {
            http_response_code(400);
        }
    }

    public function sendConfirmationMail($mailParams)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings

            //Live server settings
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->SMTPAuth = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port = 25;

            //local server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//            $mail->isSMTP();                                            // Send using SMTP
//            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
//            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//            $mail->Username   = 'raghavkumakshay@gmail.com';                     // SMTP username
//            $mail->Password   = $this->config->item('GMAIL_SECRET');                               // SMTP password
//            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//
            //Recipients
            //local server setFrom
//            $mail->setFrom('raghavkumakshay@gmail.com', 'GBD');
            //live server setFrom
            $mail->setFrom('service@goelbookdepot.macmer.in', 'Goel Book Depot Shimla');
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
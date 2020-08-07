<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->config->load('validation_rules');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function signUp()
    {
        $this->form_validation->set_rules($this->config->item('register'));
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
                $userData = [
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'created_at' => date("Y-m-d H:i:s"),
                    'confirm_user_token' => random_string('alnum', 32)
                ];

                $user = $this->AuthModel->createUser($userData);

                if ($user) {
                    $this->sendConfirmationMail($user);
                } else {
                    $this->session->set_flashdata('error', 'Account with this email already exists.');
                    redirect(site_url('home/register'));
                }
        }
    }

    public function confirmUser($token)
    {
        $email = $_GET['email'];
        $user = $this->AuthModel->confirmUser($token, $email);
        if ($user) {
            $_SESSION['user_id'] = $user->id;
            $this->session->set_flashdata('success', 'Account Verified Successfully');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('error', 'Invalid token provided. Cannot verify email');
            redirect(site_url('home/signin'));
        }
    }

    public function signIn()
    {
        $this->form_validation->set_rules($this->config->item('sign-in'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/signin');
        } else {
            $credentials = [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            ];

            $user = $this->AuthModel->attemptLogin($credentials);

            if ($user) {
                if (!$user->confirmed_user) {
                    $this->session->set_flashdata('error', 'Please verify your account before signin in');
                    redirect('home/signin');
                }
                $_SESSION['user_id'] = $user->id;
                if (isset($_SESSION['confirm_user'])) {
                    unset($_SESSION['confirm_user']);
                    redirect('home/placeorder');
                }
                redirect(site_url('user'));
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('home/signin');
            }
        }
    }

    public function reset()
    {
        $this->load->view('auth/reset');
    }

    public function sendResetLink()
    {
        $emailId = $this->input->post('email');

        if ($this->validateEmail($emailId)) {
            $this->sendMail($emailId);
        } else {
            $this->session->set_flashdata('error', 'Account does not exist');
            redirect(site_url('auth/reset'));
        }
    }

    public function createNewPassword($token)
    {
        if ($this->AuthModel->validatePasswordResetToken($token, $_GET['email'])) {
            $data['email'] = $_GET['email'];
            $this->load->view('auth/newpassword', $data);
        } else {
            $this->session->set_flashdata('error', 'This link has been expired. Try again');
            redirect(site_url('auth/reset'));
            $this->load->view('auth/reset');
        }
    }

    public function updatePassword()
    {
        $this->form_validation->set_rules($this->config->item('update-password'));

        if ($this->form_validation->run() == FALSE) {
            $data['email'] = $this->input->post('email');
            $this->load->view('auth/newpassword', $data);
        } else {
            $email = $this->input->post('email');
            $user = array(
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'password_reset_token' => NULL,
            );

            $user = $this->AuthModel->updatePassword($user, $email);

            if ($user) {
                $this->session->set_flashdata('success', 'Password Updated Successfully. Please Login');
                redirect(site_url('home/signin'));
            } else {
                $this->session->set_flashdata('error', 'Unable to update password. Something went wrong');
                redirect(site_url('auth/signin'));
            }
        }
    }

    public function validateEmail($emailId)
    {
        $user = $this->AuthModel->checkifAccountExists($emailId);
        if (!is_null($user)) {
            return true;
        }
        return false;
    }

    public function sendMail($emailId)
    {
        $this->config->load('credentials');
        $token = random_string('alnum', 32);
        $this->AuthModel->createNewPasswordToken($emailId, $token);
        $link = '<a href="'.site_url('auth/createnewpassword/').$token.'?email='.$emailId.'">'.site_url('auth/createnewpassword/').$token.'?email='.$emailId.'</a>';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings

            //Live server settings
//            $mail->isSMTP();
//            $mail->Host = 'localhost';
//            $mail->SMTPAuth = false;
//            $mail->SMTPAutoTLS = false;
//            $mail->Port = 25;

            //local server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'raghavkumakshay@gmail.com';                     // SMTP username
            $mail->Password   = $this->config->item('GMAIL_SECRET');                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            //local server setFrom
            $mail->setFrom('raghavkumakshay@gmail.com', 'GBD');
            //live server setFrom
//            $mail->setFrom('service@goelbookdepot.macmer.in', 'Goel Book Depot Shimla');
            $mail->addAddress($emailId, 'Dear Customer');     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = 'The link for your password reset is '.$link.' This Link will get expire in 10 minutes.';
//            $mail->AltBody = 'The link for your password reset is '.$link;

            $mail->send();
            $this->session->set_flashdata('success', 'Reset Link Sent to your Email');
            redirect(site_url('auth/reset'));
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Could not send link. Something went wrong');
            redirect(site_url('auth/reset'));
        }
    }

    public function sendConfirmationMail($user)
    {
        $link = '<a href="'.site_url('auth/confirmUser/').$user->confirm_user_token.'?email='.$user->email.'">'
            .site_url('auth/confirmUser/').$user->confirm_user_token.
            '?email='.$user->email.'</a>';
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'localhost';
            $mail->SMTPAuth = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port = 25;

            $mail->setFrom('service@goelbookdepot.macmer.in', 'Goel Book Depot Shimla');
            $mail->addAddress($user->email, $user->name);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome To Goel Book Depot Shimla';
            $mail->Body    = 'We are so pleased to have you as a member of Goel Book Depot Shimla. Welcome to the family.<br/>
                              Please Confirm your email to sign in to your account. To confirm click on the following link: <br/>
                              '.$link.' 
                            <br/> With Regards <br/> Goel Book Depot Shimla';

            if ($mail->send()) {
                $this->session->set_flashdata('success', 'Account Created. Verification Email is sent to your email Id');
                redirect(site_url('home/signin'));
            } else {
                $this->session->set_flashdata('error', 'Could not send Email to your provided Email Id.');
                redirect(site_url('home/signin'));
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Could not send Email to your provided Email Id.');
            redirect(site_url('home/signin'));
        }
    }
}
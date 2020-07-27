<?php


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('session');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function signUp()
    {
        $userData = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $user = $this->AuthModel->createUser($userData);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            redirect(site_url('user'));
        } else {
            redirect(site_url('home/register'));
        }
    }

    public function signIn()
    {
        $credentials = [
          'email' => $this->input->post('email'),
          'password' => $this->input->post('password')
        ];

        $user = $this->AuthModel->attemptLogin($credentials);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user->id;
            redirect(site_url('user'));
        } else {
            redirect('home/signin');
        }
    }
}
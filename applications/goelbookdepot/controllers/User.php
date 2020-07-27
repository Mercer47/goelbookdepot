<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        if (!isset($_SESSION['user_id'])) {
            redirect(site_url('home/signin'));
            session_destroy();
        }
    }

    public function index()
    {
        $this->load->view('user/index');
    }

    public function logOut()
    {
        unset($_SESSION);
        session_destroy();
        redirect('home/signin');
    }
}
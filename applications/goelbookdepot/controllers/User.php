<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Account');

        if (!isset($_SESSION['user_id'])) {
            redirect(site_url('home/signin'));
            session_destroy();
        }

        $this->userId =$_SESSION['user_id'];
    }

    public function index()
    {
        $data['userName'] = $this->Account->userName($this->userId);
        $data['orders'] = $this->Account->orders($this->userId);
        $this->load->view('user/index',$data);
    }

    public function account()
    {
        $data['userName'] = $this->Account->userName($this->userId);
        $data['details'] = $this->Account->details($this->userId);
        $this->load->view('user/account',$data);
    }

    public function logOut()
    {
        unset($_SESSION);
        session_destroy();
        redirect('home/signin');
    }
}
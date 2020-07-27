<?php


class LoginController extends CI_Controller
{
    public function __construct()
    {
        $this->load->model('AuthModel');
        $this->load->session();
    }

    public function index()
    {
        $userData = [
          ''
        ];
    }
}
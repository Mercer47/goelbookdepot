<?php


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Account');
        $this->config->load('validation_rules');

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
        $this->load->library('form_validation');
        $data['userName'] = $this->Account->userName($this->userId);
        $data['details'] = $this->Account->details($this->userId);
        $this->load->view('user/account',$data);
    }

    public function update()
    {
        $data['details'] = $this->Account->details($this->userId);

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->config->item('update-details'));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('user/account',$data);
        } else {
            $userId = $this->input->post('id');
            $user = [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            ];

            $user = $this->Account->update($user, $userId);
            if ($user) {
                $this->session->set_flashdata('success', 'Updated Successfully');
                redirect(site_url('user/account'));
            } else {
                $this->session->set_flashdata('error', 'Unable to Update. Something went wrong');
                redirect(site_url('user/account'));
            }
        }
    }

    public function changePassword()
    {
        $this->load->library('form_validation');
        $data['userName'] = $this->Account->userName($this->userId);
        $data['userId'] = $this->userId;
        $this->load->view('user/changepassword', $data);
    }

    public function updatePassword()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->config->item('change-password'));

        if ($this->form_validation->run() === FALSE) {
            $data['userName'] = $this->Account->userName($this->userId);
            $data['userId'] = $this->userId;
            $this->load->view('user/changepassword', $data);
        } else {
            $password = $this->input->post('current');
            $id = $this->input->post('id');
            $user = $this->Account->confirmCurrentPassword($id, $password);

            if (!$user) {
                $this->session->set_flashdata('error', 'You have entered a wrong current password');
                redirect(site_url('user/changepassword'));
            }

            $user = [
                'password' => password_hash($this->input->post('new'), PASSWORD_BCRYPT)
            ];

            $user = $this->Account->updatePassword($user, $id);
            if ($user) {
                $this->session->set_flashdata('success', 'Password Updated Successfully');
                redirect(site_url('user/account'));
            } else {
                $this->session->set_flashdata('error', 'Unable to Update. Something went wrong');
                redirect(site_url('user/account'));
            }
        }
    }

    public function logOut()
    {
        unset($_SESSION);
        session_destroy();
        redirect('home/signin');
    }
}
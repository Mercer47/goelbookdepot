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
        $this->load->library('form_validation');
        $data['userName'] = $this->Account->userName($this->userId);
        $data['details'] = $this->Account->details($this->userId);
        $this->load->view('user/account',$data);
    }

    public function update()
    {
        $data['details'] = $this->Account->details($this->userId);

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->getValidationRules());

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

    public function logOut()
    {
        unset($_SESSION);
        session_destroy();
        redirect('home/signin');
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'phone',
                'rules' => 'required|exact_length[10]|numeric',
                'errors' => [
                    'required' => 'You must enter a Phone number',
                    'exact_length' => 'Must be a 10 digit number',
                    'numeric' => 'Invalid Phone Number'
                ]
            ],
            [
                'field' => 'address',
                'rules' => 'required|min_length[15]',
                'errors' => [
                    'required' => 'You must enter your address',
                    'min_length' => 'Invalid Address. Please enter your Full Address'
                ],
            ],
            [
                'field' => 'name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'You must enter your name'
                ]
            ]
        ];
    }
}
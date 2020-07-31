<?php


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function signUp()
    {
        $this->form_validation->set_rules($this->getValidationRules('register'));
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register');
        } else {
            $userData = [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'created_at' => date("Y-m-d H:i:s")
            ];

            $user = $this->AuthModel->createUser($userData);

            if ($user) {
                $_SESSION['user_id'] = $user->id;
                redirect(site_url('user'));
            } else {
                $this->session->set_flashdata('error', 'Cannot Create Account. Something went wrong');
                redirect(site_url('home/register'));
            }
        }
    }

    public function signIn()
    {
        $this->form_validation->set_rules($this->getValidationRules('sign-in'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/signin');
        } else {
            $credentials = [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            ];

            $user = $this->AuthModel->attemptLogin($credentials);

            if ($user) {
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

    public function getValidationRules($page)
    {
        if (strcmp($page,'sign-in') == 0) {
            return [
                [
                    'field' => 'email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Must be a Valid email'
                        ]
                ],
                [
                    'field' => 'password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'You must enter a Password',
                        'min_length' => 'Password must be grater than 8 characters'
                    ]
                ],
            ];
        } elseif (strcmp($page, 'register') == 0) {
            return [
                [
                    'field' => 'email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Must be a Valid email'
                    ]
                ],
                [
                    'field' => 'password',
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'You must enter a Password',
                        'min_length' => 'Password must be grater than 8 characters'
                    ]
                ],
                [
                    'field' =>  'confirm',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'You must confirm your password',
                        'matches' => 'Passwords does not match'
                    ]
                ],
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
        return [];
    }
}
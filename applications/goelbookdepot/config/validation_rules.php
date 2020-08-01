<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['placeOrder'] = [
    [
        'field' => 'email',
        'rules' => 'required|valid_email',
        'errors' => [
            'required' => 'Email is required',
            'valid_email' => 'Must be a Valid email'
        ]
    ],
    [
        'field' => 'contact',
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

$config['register'] = [
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

$config['sign-in'] = [
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

$config['update-password'] = [
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
];

$config['update-details'] = [
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

$config['change-password'] =[
    [
        'field' => 'current',
        'rules' => 'required|min_length[8]',
        'errors' => [
            'required' => 'You must enter your current Password',
            'min_length' => 'Password must be grater than 8 characters'
        ]
    ],
    [
        'field' => 'new',
        'rules' => 'required|min_length[8]|differs[current]',
        'errors' => [
            'required' => 'You must enter a new Password',
            'min_length' => 'Password must be grater than 8 characters',
            'differs' => 'Current and New password cannot be same'
        ]
    ],
    [
        'field' =>  'confirm',
        'rules' => 'required|matches[new]',
        'errors' => [
            'required' => 'You must confirm your password',
            'matches' => 'Passwords does not match'
        ]
    ],
];
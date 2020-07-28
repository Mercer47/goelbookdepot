<?php


class Bundle extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BundleModel');
    }

    public function index()
    {
        $data['title'] = 'Bundle Store';
        $data['bundles'] = $this->BundleModel->getBundles();
        $this->load->view('bundles/list', $data);
    }

    public function view($id)
    {
        $data['bundle'] = $this->BundleModel->getBundle($id);
        $data['title'] = $data['bundle']->name;
        $this->load->view('bundles/view',$data);
    }


}
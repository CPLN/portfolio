<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('pages/user/index');
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $this->load->library('table');

        $this->form_validation->set_rules('email', trans('pf_email'), 'trim|required');

        if ($this->form_validation->run())
        {
            echo 'OK';
        }

        $this->load->view('templates/header');
        $this->load->view('pages/user/login');
        $this->load->view('templates/footer');
    }

    public function login_confirm($token) {

    }
}

 ?>

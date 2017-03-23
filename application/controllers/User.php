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

        $this->form_validation->set_rules('email', trans('pf_email'), 'trim|required|valid_email');

        if ($this->form_validation->run())
        {
            $email = trim($this->input->post('email'));
            $this->user_model->setToken($email);

            // TODO Envoyer l'e-mail

            $this->load->view('templates/header', ['title' => trans('pf_email_sent')]);
            $this->load->view('pages/user/email-sent', ['email' => $email]);
            $this->load->view('templates/footer');
            return;
        }

        $this->load->view('templates/header', ['title' => trans('pf_login')]);
        $this->load->view('pages/user/login');
        $this->load->view('templates/footer');
    }

    public function login_confirm($token) {

    }
}

 ?>

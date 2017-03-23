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
            $token = $this->user_model->setUpToken($email);

            $this->load->library('email');
            $this->email->from(PF_LOGIN_EMAIL_SENDER);
            $this->email->to($email);
            $this->email->subject(trans('pf_login_email_subject'));
            $this->email->message(trans('pf_login_email_message', site_url('user/login_confirm/' . $token)));
            // TODO Décommenter pour faire un envoi réel: $this->email->send();

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

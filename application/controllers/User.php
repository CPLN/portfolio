<?php

class User extends CI_Controller
{
    public function __constructor()
    {
        parent::__constructor();
        $this->load->database();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('pages/user/index');
        $this->load->view('templates/footer');
    }
}

 ?>

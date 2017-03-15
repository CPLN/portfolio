<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 14:59
 */
class Domain extends CI_Controller
{

    /**
     * Domain constructor.
     * First we call the parent construct to initialize all methods
     * and then, we charge the database query builder
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Domain_model');
    }

    public function index()
    {
        $domains = $this->Domain_model->findAll();
        $this->load->view('templates/header', ['title' => lang('pf_home')]);
        $this->load->view('pages/domain/index', ['domains' => $domains]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->view('templates/header', ['title' => lang('pf_add')]);
        $this->load->view('pages/domain/add');
        $this->load->view('templates/footer');
    }

    public function delete($id = 0)
    {
        $this->load->view('templates/header', ['title' => lang('pf_delete')]);
        $this->load->view('pages/domain/delete', ['id' => $id]);
        $this->load->view('templates/footer');
    }
}
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
        $this->load->model('domain_model');
    }

    public function index()
    {
        $domains = $this->domain_model->findAll();
        $this->load->view('templates/header', ['title' => trans('pf_home')]);
        $this->load->view('pages/domain/index', ['domains' => $domains]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('table');

        $name = $this->input->post('name');

        $this->form_validation->set_rules('name', trans('pf_name'), 'trim|required|is_unique[domains.name]');
        if($this->form_validation->run()) {
            //TODO $domain = new object();
            $domain->name = $name;

            $this->domain_model->add($domain);
            redirect('/domain'); //TODO Rediriger vers show
        }
        $this->load->view('templates/header', ['title' => trans('pf_add')]);
        $this->load->view('pages/domain/add', array('name' => $name));
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
      $domain = $this->domain_model->findOne($id);

      $this->load->view('templates/header', ['title' => $domain->name]);
      $this->load->view('pages/domain/show', ['domain' => $domain]);
      $this->load->view('templates/footer');
    }

    public function edit($id)
    {
      $this->load->library('table');

      $domain = $this->domain_model->findOne($id);

      if ($this->input->post('name') === $domain->name) {
        redirect('/domain/show/' . $id);
      }

      $name = $this->input->post('name') ?: $domain->name;

      $this->form_validation->set_rules('name', trans('pf_name'), 'trim|required|is_unique[domains.name]');
      if($this->form_validation->run()) {
          $domain->name = $name;
          $this->domain_model->edit($domain);
          redirect('/domain/show/' . $id);
      }

      $this->load->view('templates/header', ['title' => $domain->name]);
      $this->load->view('pages/domain/edit', ['domain' => $domain, 'name' => $name]);
      $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $domain = $this->domain_model->findOne($id);
        $validation = $this->input->post('delete_confirm');
        if (isset($validation)) {
          $this->domain_model->delete($domain);
          redirect('/domain');
        }
        $this->load->view('templates/header', ['title' => trans('pf_delete')]);
        $this->load->view('pages/domain/delete', ['domain' => $domain]);
        $this->load->view('templates/footer');
    }
}

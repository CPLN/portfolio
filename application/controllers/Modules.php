<?php

/**
 * Created by PhpStorm.
 * User: ccaillet
 * Date: 22.03.17
 * Time: 17:05
 */
class Modules extends CI_Controller
{

    /**
     * Modules constructor.
     * First we call the parent construct to initialize all methods
     * and then, we charge the database query builder
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('modules_model');
    }

    public function index()
    {
        $domains = $this->modules_model->findAll();
        $this->load->view('templates/header', ['title' => lang('pf_home')]);
        $this->load->view('pages/modules/index', ['modules' => $modules]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('table');

        $ictCode = $this->input->post('ictcode');
        $title = $this->input->post('title');
        $this->form_validation->set_rules('ictcode', lang('pf_module_code'), 'trim|required|is_unique[domains.name]');
        $this->form_validation->set_rules('title', lang('pf_module_title'), 'trim|required');
        if($this->form_validation->run()) {
            $module->ictCode = $ictCode;
            $module->title   = $title;
            $this->modules_model->add($module);
            redirect('/modules');
        }
        $this->load->view('templates/header', ['title' => lang('pf_add')]);
        $this->load->view('pages/modules/add', array('ictcode' => $ictCode, 'title' => $title));
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
      $domain = $this->modules_model->findOne($id);

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

      $this->form_validation->set_rules('name', lang('pf_name'), 'trim|required|is_unique[domains.name]');
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
        $this->load->view('templates/header', ['title' => lang('pf_delete')]);
        $this->load->view('pages/domain/delete', ['domain' => $domain]);
        $this->load->view('templates/footer');
    }
}

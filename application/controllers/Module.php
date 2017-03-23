<?php

/**
 * Created by PhpStorm.
 * User: ccaillet
 * Date: 22.03.17
 * Time: 17:05
 */
class Module extends CI_Controller
{

    /**
     * module constructor.
     * First we call the parent construct to initialize all methods
     * and then, we charge the database query builder
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('module_model');
    }

    public function index()
    {
        $modules = $this->module_model->findAll();
        $this->load->view('templates/header', ['title' => trans('pf_home')]);
        $this->load->view('pages/module/index', ['modules' => $modules]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('table');

        $ictCode = $this->input->post('ictcode', TRUE);
        $title = $this->input->post('title', TRUE);
        $this->form_validation->set_rules('ictcode', trans('pf_module_code'), 'trim|required|is_unique[modules.ictCode]');
        $this->form_validation->set_rules('title', trans('pf_module_title'), 'trim|required');
        if($this->form_validation->run()) {
			$module = new StdClass();
            $module->ictCode = $ictCode;
            $module->title   = $title;
            $this->module_model->add($module);
            redirect('/module');
        }
        $this->load->view('templates/header', ['title' => trans('pf_add')]);
        $this->load->view('pages/module/add', ['ictcode' => $ictCode, 'title' => $title]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
      $module = $this->module_model->findOne($id);

      $this->load->view('templates/header', ['title' => $module->title]);
      $this->load->view('pages/module/show', ['module' => $module]);
      $this->load->view('templates/footer');
    }

    public function edit($id)
    {
      $this->load->library('table');

      $module = $this->module_model->findOne($id);

      if ($this->input->post('ictcode', TRUE) === $module->ictCode) && 
	     ($this->input->post('title', TRUE) === $module->title){
        redirect('/module/show/' . $id);
      }

	  $ictCode = $this->input->post('ictcode') ?: $module->ictCode;
      $title = $this->input->post('title') ?: $module->title;

 
		$this->form_validation->set_rules('ictcode', trans('pf_module_code'), 'trim|required|is_unique[modules.ictCode]');
		$this->form_validation->set_rules('title', trans('pf_module_title'), 'trim|required');
		if($this->form_validation->run()) {
			$module->ictCode = $ictCode;
			$module->title   = $title;
			//@todo id =  $this->module_model->add($module);
			// redirect('/module/show/' . $id);
        }	  

      $this->load->view('templates/header', ['title' => $module->ictCode.'-'.$module->title]);
      $this->load->view('pages/module/edit', ['module' => $module, 'ictcode' => $ictCode, 'title' => $title]);
      $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $module = $this->module_model->findOne($id);
        $validation = $this->input->post('delete_confirm');
        if (isset($validation)) {
          $this->module_model->delete($module);
          redirect('/module');
        }
        $this->load->view('templates/header', ['title' => trans('pf_delete')]);
        $this->load->view('pages/module/delete', ['module' => $module]);
        $this->load->view('templates/footer');
    }
}

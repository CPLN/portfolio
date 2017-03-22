<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 14:59
 */
class Material extends CI_Controller
{

    /**
     * Material constructor.
     * First we call the parent construct to initialize all methods
     * and then, we charge the database query builder
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('material_model');
    }

    public function index()
    {
        $materials = $this->material_model->findAll();
        $this->load->view('templates/header', ['title' => lang('pf_home')]);
        $this->load->view('pages/material/index', ['materials' => $materials]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('table');

        $name = $this->input->post('name', TRUE);

        if(is_array($name)) {
            redirect('/material');
        }

        $this->form_validation->set_rules('name', lang('pf_name'), 'trim|required|is_unique[materials.name]');
        if($this->form_validation->run()) {
            $material = (object) ['name' => $name];
            $this->material_model->add($material);
            redirect('/material');
        }
        $this->load->view('templates/header', ['title' => lang('pf_add')]);
        $this->load->view('pages/material/add', ['name' => $name]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
      $material = $this->material_model->findOne($id);
      if(is_null($material)) {
          redirect('/material'); // évite un message d'erreur si l'utilisateur change le numéro dans la barre d'adresse
      }

      $this->load->view('templates/header', ['title' => $material->name]);
      $this->load->view('pages/material/show', ['material' => $material]);
      $this->load->view('templates/footer');
    }

    public function edit($id)
    {
      $this->load->library('table');

      $material = $this->material_model->findOne($id);

      if ($this->input->post('name', TRUE) === $material->name) {
        redirect('/material/show/' . $id);
      }

      $name = $this->input->post('name', TRUE) ?: $material->name;

      $this->form_validation->set_rules('name', lang('pf_name'), 'trim|required|is_unique[materials.name]');
      if($this->form_validation->run()) {
          $material->name = $name;
          $this->material_model->edit($material);
          redirect('/material/show/' . $id);
      }

      $this->load->view('templates/header', ['title' => $material->name]);
      $this->load->view('pages/material/edit', ['material' => $material, 'name' => $name]);
      $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $material = $this->material_model->findOne($id);
        $validation = $this->input->post('delete_confirm', TRUE);
        if (isset($validation)) {
          $this->material_model->delete($material);
          redirect('/material');
        }
        $this->load->view('templates/header', ['title' => lang('pf_delete')]);
        $this->load->view('pages/material/delete', ['material' => $material]);
        $this->load->view('templates/footer');
    }
}

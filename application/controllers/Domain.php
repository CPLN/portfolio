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
    }

    public function index()
    {
        $page = 'index';
        if ( ! file_exists(APPPATH.'views/pages/domain/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = 'Accueil';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/domain/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        $data['title'] = 'Ajouter';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/domain/add', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete($id = 0)
    {
        $page = 'del';
        if ( ! file_exists(APPPATH.'views/pages/domain/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = 'Supprimer';
        $data['id'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('pages/domain/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}
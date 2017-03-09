<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 14:59
 */
class Domain extends CI_Controller
{
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

    public function add($id = 0)
    {
        $page = 'add';
        if ( ! file_exists(APPPATH.'views/pages/domain/'.$page.'.php'))
        {
            show_404();
        }
        $this->load->helper('portfolio_helper');
        $ret = sanitize_int($id);
        if($ret !== FALSE) {
            $data['id'] = $ret;
        }
        else {
            show_error("La valeur fournie n'est pas une valeur entière valide");
            header('index.php');
        }
        $data['title'] = 'Ajouter';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/domain/'.$page, $data);
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
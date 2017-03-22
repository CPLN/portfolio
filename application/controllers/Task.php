<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 14:59
 */
class Task extends CI_Controller
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
        $this->load->model('task_model');
    }

    public function index()
    {
        $tasks = $this->task_model->findAll();
        $this->load->view('templates/header', ['title' => lang('pf_home')]);
        $this->load->view('pages/task/index', ['tasks' => $tasks]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('table');
        $task = (object)$this->input->post(NULL, TRUE);

        $rules = [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'trim|required|is_unique[tasks.name]'
            ],
            [
                'field' => 'description',
                'label' => 'description',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'goal',
                'label' => 'goal',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'duration',
                'label' => 'duration',
                'rules' => 'trim|required|integer'
            ],
            [
                'field' => 'level',
                'label' => 'level',
                'rules' => 'trim|required|integer'
            ],
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {
            $this->task_model->add($task);
            redirect('/task');
        }
        $this->load->view('templates/header', ['title' => lang('pf_add')]);
        $this->load->view('pages/task/add', ['task' => $task]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $task = $this->task_model->findOne($id);
        if (is_null($task)) {
            redirect('/task'); // évite un message d'erreur si l'utilisateur change le numéro dans la barre d'adresse
        }

        $this->load->view('templates/header', ['title' => $task->name]);
        $this->load->view('pages/task/show', ['task' => $task]);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $this->load->library('table');

        $task = $this->task_model->findOne($id);

        if ($this->equal($task, $this->input->post(NULL, TRUE))) {
            redirect('/task/show/' . $id);
        }

        $rules = [
            [
                'field' => 'name',
                'label' => 'name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'description',
                'label' => 'description',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'goal',
                'label' => 'goal',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'duration',
                'label' => 'duration',
                'rules' => 'trim|required|integer'
            ],
            [
                'field' => 'level',
                'label' => 'level',
                'rules' => 'trim|required|integer'
            ],
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {
            $editedTask = (object)$this->input->post(NULL, TRUE);
            $editedTask->id = $task->id;
            $this->task_model->edit($editedTask);
            redirect('/task/show/' . $id);
        }

        $this->load->view('templates/header', ['title' => $task->name]);
        $this->load->view('pages/task/edit', ['task' => $task]);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $task = $this->task_model->findOne($id);
        $validation = $this->input->post('delete_confirm', TRUE);
        if (isset($validation)) {
            $this->task_model->delete($task);
            redirect('/task');
        }
        $this->load->view('templates/header', ['title' => lang('pf_delete')]);
        $this->load->view('pages/task/delete', ['task' => $task]);
        $this->load->view('templates/footer');
    }

    private function equal($var1, $var2)
    {
        // Si ça vient du model c'est un objet, si ça vient du POST c'est un tableau...
        $array1 = is_object($var1) ? (array)$var1: $var1;
        $array2 = is_object($var2) ? (array)$var2: $var2;

        // Si ça vient du POST alors il y a le bouton -> on l'enlève car on ne l'édite pas
        if(isset($array1['submit'])) unset($array1['submit']);
        if(isset($array2['submit'])) unset($array2['submit']);

        // Si ça vient du model, alors il y a l'id -> on l'enlève car on ne l'édite pas
        if(isset($array1['id'])) unset($array1['id']);
        if(isset($array2['id'])) unset($array2['id']);

        // mandatory et onlyOnce sont des cases à cocher qui ne
        // sont pas présente dans POST si on ne les coches pas...
        if(!isset($array1['mandatory'])) $array1['mandatory'] = 0;
        if(!isset($array2['mandatory'])) $array2['mandatory'] = 0;

        if(!isset($array1['onlyOnce'])) $array1['onlyOnce'] = 0;
        if(!isset($array2['onlyOnce'])) $array2['onlyOnce'] = 0;

        return count(array_diff_assoc($array1, $array2)) ? FALSE : TRUE;
    }
}

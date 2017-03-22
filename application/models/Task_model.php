<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 15.03.17
 * Time: 09:15
 */
class Task_model extends CI_Model
{
    const TABLE = 'tasks';

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function findOne($id)
    {
        $tasks = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
        if (count($tasks) > 0) {
            return $tasks[0];
        }
        return null;
    }

    public function add($task)
    {
        $task = $this->clean($task);
        return $this->db->insert(self::TABLE, $task);
    }

    public function edit($task)
    {
        $task = $this->clean($task);
        var_dump($task);
        $this->db->where('id', $task->id);
        return $this->db->update(self::TABLE, $task);
    }

    public function delete($task)
    {
        $this->db->where('id', $task->id);
        return $this->db->delete(self::TABLE);
    }

    public function clean($task)
    {
        if (isset($task->submit)) unset($task->submit);     // supprime le bouton Sumbit
        if (!isset($task->mandatory)) $task->mandatory = 0; // gère le cas des cases à cocher
        if (!isset($task->onlyOnce)) $task->onlyOnce = 0; // Si pas coché, elles ne sont pas présente dans $task...

        foreach ($task as $key => $value) {
            $task->{$key} = trim($value);
        }
        return $task;
    }
}

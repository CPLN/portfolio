<?php

/**
 * User: ccaillet
 * Date: 15.03.17
 * Time: 09:15
 */
class Module_model extends CI_Model
{
    const TABLE = 'modules';

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function findOne($id)
    {
        $modules = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
        if (count($modules) > 0) {
            return $modules[0];
        }
        return null;
    }

    public function add($module)
    {
        $module = $this->clean($module);
        $this->db->insert(self::TABLE, $module);
        return $this->db->insert_id();
    }

    public function clean($module)
    {
        $module->ictCode = trim($module->ictCode);
        $module->title = trim($module->title);
        return $module;
    }

    public function edit($module)
    {
        $module = $this->clean($module);
        $this->db->where('id', $module->id);
        return $this->db->update(self::TABLE, $module);
    }

    public function delete($module)
    {
        $this->db->where('id', $module->id);
        return $this->db->delete(self::TABLE);
    }
}

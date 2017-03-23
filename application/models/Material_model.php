<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 15.03.17
 * Time: 09:15
 */
class Material_model extends CI_Model
{
    const TABLE = 'materials';

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function findOne($id)
    {
      $materials = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
      if (count($materials) > 0) {
        return $materials[0];
      }
      return null;
    }

    public function add($material)
    {
      $material = $this->clean($material);
      return $this->db->insert(self::TABLE, $material);
    }

    public function edit($material)
    {
      $material = $this->clean($material);
      $this->db->where('id', $material->id);
      return $this->db->update(self::TABLE, $material);
    }

    public function delete($material)
    {
      $this->db->where('id', $material->id);
      return $this->db->delete(self::TABLE);
    }

    public function clean($material)
    {
      $material->name = trim($material->name);
      return $material;
    }
}

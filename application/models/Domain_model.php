<?php

/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 15.03.17
 * Time: 09:15
 */
class Domain_model extends CI_Model
{
    const TABLE = 'domains';

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }
}
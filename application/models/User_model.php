<?php

class User_model extends CI_Model
{
    const TABLE = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function getAnonymous()
    {
        $user = new stdClass();
        $user->name = trans('pf_anonymous');
        $user->email = 'nomail@nomail';
        return $user;
    }

    public function generateToken($length = 20)
    {
        $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';

        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $allowedCharacters[rand(0, strlen($allowedCharacters) - 1)];
        }
        return $token;
    }

    public function setToken()
    {
        $token = $this->generateToken();
        $user = get_user();
        $user->token = $token;
        $user->tokenValidity = time();
    }
}

 ?>

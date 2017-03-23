<?php

class User_model extends CI_Model
{
    const TABLE = 'users';
    const TOKEN_VALIDITY_DURATION = 60 * 5; // 5 minutes

    public function __construct()
    {
        parent::__construct();
    }

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function findOneBy($where)
    {
        $users = $this->db->get_where(self::TABLE, $where)->result_object();
        if (sizeof($users) == 0) return $this->getAnonymous();
        return $users[0];
    }

    public function getAnonymous()
    {
        $user = new stdClass();
        $user->id = 0;
        $user->name = trans('pf_anonymous');
        $user->email = 'nomail@nomail';
        return $user;
    }

    public function add($user)
    {
        $this->db->insert(self::TABLE, $user);
        return $this->db->insert_id();
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

    public function setUpToken($email)
    {
        $user = $this->findOneBy(compact('email'));
        if ($user->id == 0)
        {
            $user = new StdClass();
            $user->email = $email;
            $user->id = $this->add($this->clean($user));
        }

        $token = $this->generateToken();
        $user->token = $token;
        $user->tokenValidity = time() + self::TOKEN_VALIDITY_DURATION;
        $this->db->update(self::TABLE, $user, ['id' => $user->id]);
        return $token;
    }

    public function getUserFromToken($token)
    {
        $users = $this->db->get_where(self::TABLE, compact('token'))->result_object();
        if (sizeof($users) == 0) return $this->getAnonymous();

        $user = $users[0];
        if ($user->tokenValidity >= time())
        {
            $this->invalidateToken($user);
            return $user;
        }
        return $this->getAnonymous();
    }

    private function invalidateToken($user)
    {
        $user->tokenValidity = 0;
        $this->db->where(['id' => $user->id]);
        $this->db->update(self::TABLE, $user);
    }

    private function clean($user)
    {
        $user->email = trim($user->email);
        return $user;
    }
}

?>

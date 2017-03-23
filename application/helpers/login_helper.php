<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('remember_user'))
{
    function remember_user($user)
    {
        $_SESSION['authenticatedUser'] = $user;
    }
}

if (!function_exists('get_user'))
{
    function get_user() {
        $user = null;
        try
        {
            if (!isset($_SESSION['authenticatedUser'])) throw new Exception();
            $user = $_SESSION['authenticatedUser'];
            if ($user === null) throw new Exception();
        }
        catch (Exception $e)
        {
            $CI = get_instance();
            $CI->load->model('user_model');
            $user = $CI->user_model->getAnonymous();
        }
        finally
        {
            return $user;
        }
    }
}

if (!function_exists('has_role'))
{
    function has_role($role) {
        //TODO Faire quelque chose
        return false;
    }
}

if (!function_exists('forget_user'))
{
    function forget_user() {
        $_SESSION['authenticatedUser'] = null;
    }
}

?>

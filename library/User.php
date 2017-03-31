<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 30.03.2017
 * Time: 9:19
 */
class User
{
    private $db;

    private static $user = null;

    private function __construct()
    {
        $this->db = new mysqli('localhost','root','root','firstbase');
        $this->db->query('SET NAMES "utf-8"');
    }

    public static function getObject()
    {
        if(self::$user === null)
        {
            self::$user = new User();
        }
        return self::$user;
    }

    public function regUser($login, $password)
    {
        if($login == "" || $password == "")
        {
            return false;
        }
        else
        {
            $password = md5($password);
            return $this->db->query("INSERT INTO `users` (`id`, `login`, `password`, `regdate`) values(null, '$login', '$password', '" . time() . "')");
        }
    }

    public function loginUser($login, $password)
    {
        $password = md5($password);
        if($this->checkLoginUser($login, $password))
        {
            session_start();

            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            return true;
        }
        else
        {
            return false;
        }
    }

    private function checkLoginUser($login, $password)
    {
        $findLogin = $this->db->query("SELECT `password` FROM `users` WHERE `login` = '$login'");
        if(empty($findLogin))
        {
            return false;
        }
        else {
            $resultFindLogin = $findLogin->fetch_assoc();
            return $password === $resultFindLogin['password'];
        }
    }

    public function isAuth()
    {
        session_start();
        if(!isset($_SESSION['login']) || !isset($_SESSION['password']))
        {
            return false;
        }

        $login = $_SESSION['login'];
        $password = $_SESSION['password'];

        return $this->checkLoginUser($login, $password);
    }

    public function __destruct()
    {
        if($this->db)
        {
            $this->db->close();
        }
    }
}
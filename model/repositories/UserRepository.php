<?php


namespace app\model\repositories;


use app\model\entities\Basket;
use app\model\Repository;
use app\model\entities\Users;


class UserRepository extends Repository
{
    public function isAuth() {
        return isset($_SESSION['login']);
    }

    public function isAdmin() {
        return $_SESSION['login'] == 'admin';
    }

    public function getName() {
        return $_SESSION['login'];
    }

    public function auth($login, $pass)
    {
        $user = (new UserRepository())->getOneWhere('login', $login);
        if (password_verify($pass, $user->pass)) {
            //Авторизуем пользователя
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user->id;
            return true;
        } else {
            return  false;
        }
    }

    public function getEntityClass()
    {
        return Users::class;
    }

    public function getTableName()
    {
        return "users";
    }
}
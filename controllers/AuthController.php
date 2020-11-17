<?php


namespace app\controllers;


use app\model\repositories\UserRepository;

class AuthController extends Controller
{
    public function actionLogin()
    {
        //TODO предеделать через Request!
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        if ((new UserRepository())->auth($login, $pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
        } else {
            die("Не верный логин-пароль");
        }
    }

    public function actionLogout()
    {
        session_destroy();
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }


}
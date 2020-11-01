<?php

namespace app\model;

class Users extends Model
{
    public $id;
    public $login;
    public $pass;

    //TODO добавить конструктор
    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public function getTableName()
    {
        return "users";
    }
}

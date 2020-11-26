<?php

namespace app\model;

class Users extends DBModel
{
    protected $id;
    protected $login;
    protected $pass;

    public $props = [
        'login' => false,
        'pass' => false,
    ];


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function getTableName()
    {
        return "users";
    }
}
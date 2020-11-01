<?php

namespace app\model;

class Basket extends Model
{
    public $id;
    public $session_id;
    public $goods_id;


    public function getTableName()
    {
        return "basket";
    }
}

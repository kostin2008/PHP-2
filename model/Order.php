<?php

namespace app\model;

class Order extends Model
{
    public $id;
    public $created_at;
    public $user_id;
    public $status;


    public function getTableName()
    {
        return "order";
    }
}

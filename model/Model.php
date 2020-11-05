<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel
{

    public function __set($name, $value)
    {
        if ($this->$name != $value) {
            $this->$name = $value;
            $this->props[$name] = true;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }
}

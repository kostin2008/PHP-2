<?php


namespace app\model;


class Model
{
    public function __set($name, $value) {
        //TODO проверить по props есть ли такое поле
        $this->props[$name] = true;
        $this->$name = $value;
    }

    public function __get($name)
    {
        //TODO проверить по props есть ли такое поле
        return $this->$name;
    }

    public function __isset($name) {
        return isset($this->$name);
    }
}
<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel
{

    public function first($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id]);
    }

    public function get()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return Db::getInstance()->queryAll($sql);
    }

    //TODO реализовать insert
    public function insert()
    {
        $params = [];
        $columns = '';
        $values = '';
        foreach ($this as $key => $value) {
            $params["$key"] = $this->$key;
            $columns .= "{$key}, ";
            $values .= ":{$key}, ";
        }
        $columns = mb_substr($columns, 0, -2);
        $values = mb_substr($values, 0, -2);
        $sql = "INSERT INTO {$this->getTableName()} ($columns) VALUES ($values)";
        DB::getInstance()->execute($sql, $params);
        $this->id = DB::getInstance()->getLustInsertId();
    }

    public function update()
    {
        $params = [];
        $values = '';
        foreach ($this as $key => $value) {
            $params["$key"] = $this->$key;
            $values .= ":{$key}, ";
        }
        $values = mb_substr($values, 0, -2);
        $params['id'] = $this->id;
        $sql = "UPDATE {$this->getTableName()} SET ($values) WHERE id = :id";
        DB::getInstance()->execute($sql, $params);
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        DB::getInstance()->execute($sql, ['id' => $this->id]);
    }

    abstract public function getTableName();
}

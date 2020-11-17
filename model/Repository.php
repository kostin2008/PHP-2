<?php

namespace app\model;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Repository implements IModel
{

    public function first($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getOneWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}`=:value";
        return Db::getInstance()->queryObject($sql, ['value' => $value], $this->getEntityClass());

    }

    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$field}`=:value";

        return Db::getInstance()->queryOne($sql, ["value" => $value])['count'];
    }

    public function get()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function getLimit($page) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }

    //TODO реализовать insert
    public function insert(Model $entity) {
        $tableName = $this->getTableName();

        $params = [];
        $columns = [];


        foreach ($entity->props as $key => $value) {

            $params[":{$key}"] = $entity->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $entity->id = Db::getInstance()->lastInsertId();

    }

    public function update(Model $entity) {
        $params = [];
        $colums = [];

        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $entity->$key;
            $colums[] .= "`" . $key . "` = :" . $key;
            $entity->props[$key] = false;
        }
        $colums = implode(", ", $colums);
        $params[':id'] = $entity->id;
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        Db::getInstance()->execute($sql, $params);

    }

    public function save(Model $entity) {
        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public function delete(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $entity->id])->rowCount();
    }

    abstract public function getEntityClass();
    abstract public function getTableName();

}
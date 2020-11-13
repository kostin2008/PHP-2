<?php


namespace app\model;


use app\engine\Db;

abstract class DBModel extends Model
{
    public static function first($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getOneWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}`=:value";
        return Db::getInstance()->queryObject($sql, ['value' => $value], static::class);

    }

    public static function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$field}`=:value";

        return Db::getInstance()->queryOne($sql, ["value" => $value])['count'];
    }

    public static function get()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($page) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }

    //TODO реализовать insert
    public function insert() {
        $tableName = static::getTableName();

        $params = [];
        $columns = [];


        foreach ($this->props as $key => $value) {

            $params[":{$key}"] = $this->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();

        return $this;
    }

    public function update() {
        $params = [];
        $colums = [];

        foreach ($this->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $this->$key;
            $colums[] .= "`" . $key . "` = :" . $key;
            $this->props[$key] = false;
        }
        $colums = implode(", ", $colums);
        $params[':id'] = $this->id;
        $tableName = static::getTableName();
        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function save() {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id])->rowCount();
    }

    abstract public static function getTableName();
}
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

    public static function get()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($page)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return Db::getInstance()->queryLimit($sql, $page);
    }

    //TODO реализовать insert
    public function insert()
    {
        $tableName = static::getTableName();

        $params = [];
        $columns = [];
        $values = [];

        foreach ($this->props as $key => $value) {
            $params["$key"] = $this->$key;
            $columns .= "{$key}, ";
            $values .= ":{$key}, ";
        }

        $columns = mb_substr($columns, 0, -2);
        $values = mb_substr($values, 0, -2);

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();

        return $this;
    }

    public function update()
    {
        $params = [];
        $str = '';
        foreach ($this->props as $key => $value) {
            if (!$this->props[$key]) continue;
            $params["$key"] = $this->$key;
            $str .= "{$key} = :{$key}, ";
        }
        $str = mb_substr($str, 0, -2);
        $sql = "UPDATE {$this->getTableName()} SET ";
        $sql .= $str;
        $params['id'] = $this->id;
        $sql .= " WHERE id = :id";
        return Db::getInstance()->execute($sql, $params);
    }

    public function save()
    {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id])->rowCount();
    }

    abstract public static function getTableName();
}

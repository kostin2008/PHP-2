<?php


namespace app\model\repositories;


use app\model\entities\Products;
use app\model\Repository;

class ProductRepository extends Repository
{

    public function getEntityClass() {
        return Products::class;
    }

    public function getTableName() {
        return "products";
    }
}
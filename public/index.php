<?php
//TODO сделать все пути абсолютными
include __DIR__ . "/../config/config.php";

use app\model\{Products, Users};
use app\engine\Autoload;

include __DIR__ . "/../engine/Autoload.php";



spl_autoload_register([new Autoload(), 'loadClass']);


$product = new Products('Кофе', 'Молотый', 115);
$users = new Users('Ivan', 444);

//CRUD

//READ
$product = $product->first(3);
var_dump($product);

//CREATE
// $product->insert();
// $users->insert();

//DELETE
// $product->delete();
// $users->delete();

//UPDATE
// $users->login = "Alex";
// $users->update();

// $product = $product->first(1);

// var_dump($product->first(1));
// var_dump(get_class_methods($users));

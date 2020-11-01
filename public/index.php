<?php

use app\model\{Products, Users, Basket, Order};
use app\engine\Db;

include "../engine/Autoload.php";

spl_autoload_register([new \app\engine\Autoload(), 'loadClass']);

$DB = new Db();

$product = new Products($DB);
$user = new Users($DB);
$basket = new Basket($DB);
$order = new Order($DB);

echo $product->first(5);
echo $user->get();
echo $basket->first(3);
echo $order->get();

// var_dump($product);

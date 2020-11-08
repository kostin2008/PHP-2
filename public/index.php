<?php
//TODO сделать все пути абсолютными
include __DIR__ . "/../config/config.php";

use app\model\{Products, Users};
use app\engine\Autoload;
use app\engine\{Render, TwigRender};
include __DIR__ . "/../engine/Autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';


spl_autoload_register([new Autoload(), 'loadClass']);


$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName);
} else {
    die("Ошибка, контроллер не существует.");
}



die();

//$product = new Products();
//$users = new Users();

//CRUD

/** @var Products $product */

//UPDATE
$product = Products::first(2);
$product->name = "Чай 2";
$product->save();
var_dump($product);
die();
//READ
$user = new Users("user");
$user->save();
var_dump($user);


//CREATE
$prodNew = new Products('Чай','Цейлонский', 23);
$prodNew->save();
//$users->insert();
//var_dump(get_class_methods($users));
var_dump($prodNew);
die();
//DELETE
$product = $product->first(1);
$product->delete();



$product = $product->first(1);

var_dump($product->get());


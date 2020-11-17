<?php
session_start();
//TODO сделать все пути абсолютными
include __DIR__ . "/../config/config.php";

use app\engine\Autoload;
use app\engine\{Render, Request};
use app\controllers\ProductController;
//include "../engine/Autoload.php";

include __DIR__ . "/../vendor/autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


try {
    $request = new Request();

    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new Render());
        $controller->runAction($actionName);
    } else {
        die("Ошибка, контроллер не существует.");
    }
} catch (\PDOException $e) {
    var_dump($e->getMessage());
    $controller = new ProductController(new Render());
    echo $controller->render('error', ['message' => $e->getMessage()]);
} catch (\Exception $e) {
    var_dump($e);
}

die();

//$product = new Products();
//$users = new Users();

//CRUD

//UPDATE
// $product = Products::first(2);
// $product->name = "Чай 2";
// $product->save();
// var_dump($product);
// die();
//READ
// $user = new Users("user");
// $user->save();
// var_dump($user);


//CREATE
// $prodNew = new Products('Чай', 'Цейлонский', 23);
// $prodNew->save();
//$users->insert();
//var_dump(get_class_methods($users));
// var_dump($prodNew);
// die();
//DELETE
// $product = $product->first(1);
// $product->delete();



// $product = $product->first(1);

// var_dump($product->get());

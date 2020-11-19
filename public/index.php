<?php

session_start();

use app\engine\App;
use app\controllers\ProductController;
use app\engine\Render;



$config = include __DIR__ . "/../config/config.php";

include realpath("../vendor/Autoload.php");

try {
    App::call()->run($config);
} catch (\PDOException $e) {
    $controller = new ProductController(new Render());
    echo $controller->render('error', ['message' => $e->getMessage()]);
    //    echo $e->getMessage();
} catch (\Exception $e) {
    var_dump($e);
}
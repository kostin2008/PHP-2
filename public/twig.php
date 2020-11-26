<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\ArrayLoader([
    'index' => '<h1>Hello {{ name }}!</h1>',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);
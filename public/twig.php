<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../twigTemplates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

echo $twig->render('home.twig', ['name' => [
    1=>2,
    2=>3
]]);
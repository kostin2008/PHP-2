<?php

echo password_hash("123", PASSWORD_DEFAULT);

die();
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../twigTemplates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

echo $twig->render('home.twig', ['name' => [
    1 => 2,
    2 => 3
]]);

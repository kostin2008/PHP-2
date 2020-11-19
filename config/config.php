<?php

use app\engine\Request;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UsersRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\OrdersRepository;
use app\engine\SimpleImage;
use app\engine\Db;

return [
    'root_dir' => dirname(__DIR__),
    'controller_namespace' => 'app\\controllers\\',
    'templates_dir' => dirname(__DIR__) . "/views/",
    'big_image_dir' => dirname(__DIR__) . "/public/img/big/",
    'middle_image_dir' => dirname(__DIR__) . "/public/img/middle/",
    'small_image_dir' => dirname(__DIR__) . "/public/img/small/",
    'qty_displayed_items' => 3,
    'status_list' => [
        1 => 'Создан',
        2 => 'Оплачен',
        3 => 'Отправлен',
    ],
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'simpleImage' => [
            'class' => SimpleImage::class
        ],

        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'feedbackRepository' => [
            'class' => FeedbackRepository::class
        ],
        'usersRepository' => [
            'class' => UsersRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ]
    ]
];
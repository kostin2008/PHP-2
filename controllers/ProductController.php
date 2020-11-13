<?php

namespace app\controllers;

use app\engine\Request;
use app\model\Products;

class ProductController extends Controller
{

    public function actionIndex() {
       // $basket = Basket::getBasket($session);
        echo $this->render('home');
    }

    public function actionCatalog() {

        //$page = (int)$_GET['page'];
        $page = (new Request())->getParams()['page'];

        $catalog = Products::getLimit(($page + 1) * GOODS_PER_PAGE);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard() {
       // $id = (int)$_GET['id'];
        $id = (new Request())->getParams()['id'];
        $product = Products::first($id);
        echo $this->render('card', [
            'product' => $product
        ]);
    }

    public function actionApiCatalog() {
        $catalog = Products::get();
        header('Content-Type: application/json');
        echo json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

}
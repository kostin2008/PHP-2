<?php


namespace app\controllers;


class BasketController extends Controller
{
    public function actionIndex() {
        //Получение корзины
        echo $this->render('basket');
    }
}
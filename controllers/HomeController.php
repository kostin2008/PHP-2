<?php

namespace app\controllers;

class HomeController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }
}

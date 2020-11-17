<?php


namespace app\controllers;


use app\engine\Request;
use app\model\repositories\BasketRepository;
use app\model\entities\Basket;

class BasketController extends Controller
{
    public function actionIndex() {
        //Получение корзины
        echo $this->render('basket', [
            'basket' => (new BasketRepository())->getBasket(session_id())
        ]);
    }

    public function actionBuy() {
        $id = (new Request())->getParams()['id'];

        $basket =new Basket(session_id(), $id);

        (new BasketRepository())->save($basket);

        $response['count'] = (new BasketRepository())->getCountWhere('session_id', session_id());
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function actionDelete() {
        $id = (new Request())->getParams()['id'];
        $session = session_id();
        $basket = (new BasketRepository())->first($id);
        if ($session == $basket->session_id) {
            (new BasketRepository())->delete($basket);
        }
        $response['count'] = (new BasketRepository())->getCountWhere('session_id', $session);
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
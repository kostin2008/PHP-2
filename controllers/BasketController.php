<?php


namespace app\controllers;


use app\engine\Request;
use app\model\Basket;

class BasketController extends Controller
{
    public function actionIndex() {
        //Получение корзины
        echo $this->render('basket', [
            'basket' => Basket::getBasket(session_id())
        ]);
    }

    public function actionBuy() {
       // $id = (int)$_POST['id'];
      //  $data = json_decode(file_get_contents('php://input'));


        (new Basket(session_id(), (new Request())->getParams()['id']))->save();

        $response['count'] = Basket::getCountWhere('session_id', session_id());
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function actionDelete() {
 
        $id = (new Request())->getParams()['id'];
        $basketItem = Basket::first($id);
        $session = session_id();
        if ($session == $basketItem->session_id) {
            if ($basketItem->count > 1) {
                $basketItem->save();
            } else {
                $basketItem->delete();
            }
        }
        $response['count'] = Basket::getCountWhere('session_id', session_id());
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
 
     }
}
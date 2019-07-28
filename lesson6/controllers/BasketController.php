<?php

namespace App\controllers;


use App\models\entities\Basket;
use App\models\repositories\BasketRepository;
use App\models\repositories\GoodRepository;

class BasketController extends Controller
{
    public function basketAction()
    {
        $params = [
            'basket' => (new BasketRepository())->getAll(),
        ];

        echo $this->render('basket/basket', $params);
    }

    public function addAction()
    {
        $id = $this->getId();

        $goodRepository = new GoodRepository();
        $good = $goodRepository->getOne($id);

        $basketRepository = new BasketRepository();
        $basket = $basketRepository->getOneWhere("id_good = {$good->id}");
        if (!$basket) {
            $basket = new Basket();
        }
        $basket->id_good = $good->id;
        $basket->quantity++;
        $basket->price = $basket->price + $good->price;
        $basketRepository->save($basket);

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function deleteAction()
    {
        $id = $this->getId();

        $basketRepository = new BasketRepository();
        $basket = $basketRepository->getOne($id);
        $basketRepository->delete($basket);

        header("Location: /basket/basket");
    }
}
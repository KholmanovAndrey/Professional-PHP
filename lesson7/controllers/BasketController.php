<?php

namespace App\controllers;

use App\models\entities\Basket;
use App\models\repositories\BasketRepository;
use App\models\repositories\GoodRepository;

class BasketController extends Controller
{
    const GOODS = 'goods';
    protected $defaultAction = 'index';

    public function indexAction()
    {
        $params = [
            'basket' => $_SESSION['goods'],
        ];

        echo $this->render('basket/basket', $params);
    }

    public function addAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            return $this->redirect();
        }

        $goodRepository = new GoodRepository();
        $good = $goodRepository->getOne($id);
        if (empty($good)) {
            return $this->redirect();
        }

        $goods = $this->session->getSession(self::GOODS);
        if (array_key_exists($id, $goods)) {
            $goods[$id]['quantity']++;
        } else {
            $goods[$id] = [
                'name' => $good->name,
                'price' => $good->price,
                'quantity' => 1,
            ];
        }

        $this->session->setSession(self::GOODS, $goods);
        return $this->redirect();
    }

    public function deleteAction()
    {
        $id = $this->getId();

        $goods = $this->session->getSession(self::GOODS);
        unset($goods[$id]);

        $this->session->setSession(self::GOODS, $goods);
        return $this->redirect();
    }
}
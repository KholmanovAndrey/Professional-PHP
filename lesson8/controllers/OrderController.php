<?php

namespace App\controllers;

use App\models\entities\Basket;
use App\models\entities\Order;
use App\models\repositories\BasketRepository;
use App\models\repositories\OrderRepository;

class OrderController extends Controller
{
    const GOODS = 'goods';
    protected $defaultAction = 'index';

    public function behavior()
    {
        return [
            'access' => [
                'role' => '@',
            ],
        ];
    }

    public function indexAction()
    {
        if (!$this->getSession('user')) {
            return $this->redirect('/user/login');
        }

        if (!empty($this->post())) {
            if (!empty($this->post('id_user')) AND
                !empty($this->post('fio')) AND
                !empty($this->post('contact')) AND
                !empty($this->post('address'))) {
                $order = new Order();
                $order->id_user = (int)$this->post('id_user');
                $order->fio = $this->post('fio');
                $order->contact = $this->post('contact');
                $order->address = $this->post('address');
                (new OrderRepository())->save($order);
                $id_order = (new OrderRepository())->lastInsertId();

                $goods = $this->session->getSession(self::GOODS);
                foreach ($goods as $key => $item) {
                    $good = new Basket();
                    $good->id_order = $id_order;
                    $good->id_good = $key;
                    $good->quantity = $item['quantity'];
                    $good->price = $item['price'];
                    (new BasketRepository())->save($good);
                }

                return $this->redirect('order/history');
            }
        }

        echo $this->render('order/order');
    }

    public function historyAction()
    {
        if (!$this->getSession('user')) {
            return $this->redirect('/user/login');
        }

        $params = [
            'order' => (new OrderRepository())->getAllWhere("id_user = '{$this->getSession('user')['id']}'")
        ];

        echo $this->render('order/history', $params);
    }
}
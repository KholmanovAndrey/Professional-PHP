<?php

namespace App\controllers;

use App\models\repositories\GoodRepository;

class GoodController extends Controller
{
    public function goodAction()
    {
        $id = $this->get('id');

        $params = [
            'good' => (new GoodRepository())->getOne($id)
        ];

        echo $this->render('good/good', $params);
    }

    public function goodsAction()
    {
        $params = [
            'goods' => (new GoodRepository())->getAll()
        ];

        echo $this->render('good/goods', $params);
    }
}
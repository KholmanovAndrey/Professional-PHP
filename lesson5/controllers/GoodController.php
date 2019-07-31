<?php

namespace App\controllers;

use App\models\Good;

class GoodController extends Controller
{
    public function goodAction()
    {
        $id = (int)$_GET['id'];

        $params = [
            'good' => Good::getOne($id)
        ];

        echo $this->render('good/good', $params);
    }

    public function goodsAction()
    {
        $params = [
            'goods' => Good::getAll()
        ];

        echo $this->render('good/goods', $params);
    }
}
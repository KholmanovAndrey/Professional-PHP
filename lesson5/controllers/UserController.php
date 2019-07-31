<?php
namespace App\controllers;

use App\models\User;

class UserController extends Controller
{

    public function userAction()
    {
        $id = (int)$_GET['id'];

        $params = [
            'user' => User::getOne($id)
        ];

        echo $this->render('user/user', $params);
    }

    public function usersAction()
    {
        $params = [
          'users' => User::getAll()
        ];

        echo $this->render('user/users', $params);
    }

    public function saveAction()
    {
        $id = (int)$_GET['id'];

        if (!empty($_POST)) {
            $user = new User();
            $user->id = $_POST['id'];
            $user->login = $_POST['login'];
            $user->name = $_POST['name'];
            $user->password = $_POST['password'];
            $user->save();
            header("Location: ?a=users");
        }

        $params = [
            'user' => User::getOne($id)
        ];

        echo $this->render('user/save', $params);
    }

    public function deleteAction()
    {
        $id = (int)$_GET['id'];

        $user = new User();
        $user->delete($id);

        header("Location: ?a=users");
    }
}
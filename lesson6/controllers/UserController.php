<?php
namespace App\controllers;

use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{

    public function userAction()
    {
        $id = $this->getId();

        $params = [
            'user' => (new UserRepository())->getOne($id)
        ];

        echo $this->render('user/user', $params);
    }

    public function usersAction()
    {
        $params = [
          'users' => (new UserRepository())->getAll()
        ];

        echo $this->render('user/users', $params);
    }

    public function saveAction()
    {
        $id = $this->getId();

        if (!empty($_POST)) {
            $userRepository = new UserRepository();
            $user = new User();
            $user->id = (int)$_POST['id'];
            $user->login = $_POST['login'];
            $user->name = $_POST['name'];
            $user->password = $_POST['password'];
            $userRepository->save($user);
            header("Location: ?a=users");
        }

        $params = [
            'user' => (new UserRepository())->getOne($id)
        ];

        echo $this->render('user/save', $params);
    }

    public function deleteAction()
    {
        $id = $this->getId();

        $userRepository = new UserRepository();
        $user = $userRepository->getOne($id);
        $userRepository->delete($user);

        header("Location: ?a=users");
    }
}
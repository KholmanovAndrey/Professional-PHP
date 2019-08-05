<?php
namespace App\controllers;

use App\main\App;
use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends AdminController
{
    public function behavior()
    {
        return [
            'access' => [
                'role' => 'admin',
                'exclude' => [
                    'action' => [
                        'login' => [
                            'role' => '&',
                        ],
                        'signup' => [
                            'role' => '&',
                        ],
                        'logout' => [
                            'role' => '@',
                        ]
                    ],
                ],
            ],
        ];
    }

    public function userAction()
    {
        $id = $this->getId();

        $params = [
            'user' => (new UserRepository())->getOne($id)
        ];

        echo $this->render('user/user', $params);
    }

    public function indexAction()
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
            return $this->redirect('/user');
        }

        $params = [
            'user' => (new UserRepository())->getOne($id)
        ];

        echo $this->render('user/save', $params);
    }

    public function deleteAction()
    {
        $id = $this->getId();

        $userRepository = App::call()->userRepository;
        $user = $userRepository->getOne($id);
        $userRepository->delete($user);

        return $this->redirect();
    }

    public function loginAction()
    {
        if (!empty($this->post())) {
            if (!empty($this->post('login')) AND
                !empty($this->post('password'))) {
                if ($user = App::call()->userRepository
                    ->login($this->post('login'), $this->post('password'))) {
                    $_SESSION['user']['id'] = $user->id;
                    $_SESSION['user']['login'] = $user->login;
                    $_SESSION['user']['name'] = $user->name;
                    return $this->redirect('/');
                }
            }
        }
        echo $this->render('user/login');
    }

    public function signupAction()
    {
        if (!empty($this->post())) {
            if (!empty($this->post('login')) AND
                !empty($this->post('name')) AND
                !empty($this->post('password'))) {
                if ($this->post('password') === $this->post('podpassword')) {
                    $user = new User();
                    $user->login = $this->post('login');
                    $user->name = $this->post('name');
                    $user->password = $this->post('password');
                    App::call()->userRepository->save($user);
                    return $this->redirect('/');
                }
            }
        }
        echo $this->render('user/signup', [
            'post' => $this->post()
        ]);
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        return $this->redirect();
    }
}
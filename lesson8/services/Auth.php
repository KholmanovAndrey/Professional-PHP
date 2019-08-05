<?php

namespace App\services;

use App\models\entities\User;
use App\models\repositories\UserRepository;

/**
 * Class Auth
 * @package App\services
 *
 * @property User $user
 */
class Auth
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function accessCheck(array $beahvior, string $controllerName, string $actionName)
    {
        if (array_key_exists('access', $beahvior)) {
            $access = $beahvior['access'];

            if (!empty($access)) {

                $id_user = $this->session->getSession('user');
                $user = (new UserRepository)->getOne($id_user['id']);

                if (array_key_exists('exclude', $access)) {
                    if (array_key_exists('action', $access['exclude'])) {
                        if (array_key_exists($actionName, $access['exclude']['action'])) {
                            if ($access['exclude']['action'][$actionName]['role'] === $user->role) {
                                return true;
                            }
                            if ($access['exclude']['action'][$actionName]['role'] === '@' && $user) {
                                return true;
                            }
                            if ($access['exclude']['action'][$actionName]['role'] == '&') {
                                return true;
                            }
                        }
                    }
                }

                if ($access['role'] == $user->role) {
                    return true;
                }

                if ($access['role'] == '@' && $user) {
                    return true;
                }

                return false;
            }

            return true;
        }

        return true;
    }
}
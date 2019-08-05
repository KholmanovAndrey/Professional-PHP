<?php

namespace App\main;

use App\controllers\ErrorController;
use App\models\repositories\UserRepository;
use App\services\Auth;
use App\services\BD;
use App\services\Request;
use App\services\Session;
use App\traits\TSingleton;

/**
 * Class App
 * @package App\main
 * @property BD bd
 * @property UserRepository userRepository
 */
class App
{
    use TSingleton;

    private $config;
    private $componentsData;
    private $components = [];

    static public function call() :App
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->config = $config;
        $this->componentsData = $config['components'];
        $this->runController();
    }


    public function getConfig($key)
    {
        if ($key == 'components') {
            return [];
        }

        return array_key_exists($key, $this->config)
            ? $this->config[$key]
            : [];
    }

    private function runController()
    {
        $request = new Request();
        $session = new Session();

        $defaultControllerName = $this->config['defaultControllerName'];
        $defaultActionName = $this->config['defaultActionName'];
        $controllerName = $request->getControllerName() ?: $defaultControllerName;
        $actionName = $request->getActionName() ?: $defaultActionName;

        $controllerClass = 'App\\controllers\\' .
            ucfirst($controllerName) . 'Controller';
        if (class_exists($controllerClass)) {
            /**@var \App\controllers\Controller $controller */
            $controller = new $controllerClass(
                new \App\services\renders\TwigRenderServices(),
                $request,
                $session
            );

            $behavior = $controller->behavior();
            $auth = new Auth($session);
            if ($auth->accessCheck(
                $behavior,
                $controllerName,
                $actionName
            )) {
                $controller->run($actionName);
            } else {
                $controller = new ErrorController(
                    new \App\services\renders\TwigRenderServices(),
                    $request,
                    $session
                );
                $controller->run('error403');
            }
        }
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (array_key_exists($name, $this->componentsData)) {
            $class = $this->componentsData[$name]['class'];
            if (!class_exists($class)) {
                return null;
            }

            if (array_key_exists('config', $this->componentsData[$name])) {
                $config = $this->componentsData[$name]['config'];
                $component = new $class($config);
            } else {
                $component = new $class();
            }
            $this->components[$name] = $component;
            return $component;
        }
        return null;
    }
}
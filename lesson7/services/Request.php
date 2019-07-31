<?php

namespace App\services;

class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $id;
    private $params;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];

            $this->params = [
                'get' => $_GET,
                'post' => $_POST,
            ];

            if ($_GET['id']) {
                $this->id = (int)$_GET['id'];
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getParams($metod, $key)
    {
        if (empty($key)) {
            return $this->params[$metod];
        }
        return array_key_exists($key, $this->params[$metod])
            ? $this->params[$metod][$key]
            : null;
    }

    public function get(string $param = '')
    {
        if ($param) {
            if ($param === 'id') return $this->getId();
            return $this->params['get'][$param];
        }
        return $this->params['get'];
    }

    public function post(string $param = '')
    {
        if ($param) {
            return $this->params['post'][$param];
        }
        return $this->params['post'];
    }
}
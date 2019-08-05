<?php

namespace App\controllers;

use App\services\renders\IRenderService;
use App\services\Request;
use App\services\Session;

class Controller
{
    protected $defaultAction = 'index';
    protected $action;
    protected $renderer;
    protected $request;
    protected $session;

    public function behavior()
    {
        return [
            'access' => [],
        ];
    }

    public function __construct(IRenderService $renderer, Request $request, Session $session)
    {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->session = $session;
    }

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            return $this->redirect('/error/error404');
        }
    }

    public function render($template, $params = [])
    {
        $currentUser = $this->getSession('user');

        if ($this->getSession('user')) {
            $params['currentUser'] = $this->getSession('user');
        }

        return $this->renderer->renderTmpl($template, $params);
//        $content = $this->renderTmpl($template, $params);
//        return $this->renderTmpl('layouts/main', [
//            'content' => $content
//        ]);
    }

    public function renderTmpl($template, $params = [])
    {
        return $this->renderer->renderTmpl($template, $params);
    }

    public function getId()
    {
        return $this->request->getId();
    }

    public function get(string $param = '')
    {
        return $this->request->get($param);
    }

    public function post(string $param = '')
    {
        return $this->request->post($param);
    }

    public function getSession($key = null)
    {
        return $this->session->getSession($key);
    }

    protected function redirect($path = '')
    {
        if (empty($path)) {
            $path = $_SERVER['HTTP_REFERER'];
        }
        return header("Location: {$path}");
    }
}
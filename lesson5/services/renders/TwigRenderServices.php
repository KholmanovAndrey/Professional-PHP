<?php
namespace App\services\renders;


class TwigRenderServices implements IRenderService
{
    public function renderTmpl($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . '/../views/');
        $twig = new \Twig\Environment($loader);

        return $twig->render($template . '.twig', $params);
    }
}
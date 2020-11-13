<?php

//$loader = new \Twig\Loader\FilesystemLoader('../twigTemplates');
//$twig = new \Twig\Environment($loader);
//return $twig->render('home.twig', ['name' => 'Alex']);

namespace app\engine;


use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{

    protected $twig;

    /**
     * TwigRender constructor.
     * @param $twig
     */
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../twigTemplates');
        $this->twig = new \Twig\Environment($loader);
    }


    public function renderTemplate($template, $params = []) {

            return $this->twig->render($template . ".twig", $params);
    }
}
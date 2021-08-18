<?php

namespace App\Controller;

use App\Lib\Sessao;

abstract class Controller
{
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->setViewParam('nameController',$app->getControllerName());
        $this->setViewParam('nameAction',$app->getAction());
    }

    public function render($view)
    {
        $viewVar   = $this->getViewVar();
        $Sessao    = Sessao::class;

        require_once PATH . '/View/layouts/header.php';
        require_once PATH . '/View/layouts/menu.php';
        require_once PATH . '/View/' . $view . '.php';
        require_once PATH . '/View/layouts/footer.php';
    }

    public function redirect($view)
    {
        header('Location: http://' . APP_HOST . $view);
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }
}
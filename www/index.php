<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

use App\App;
use App\Lib\Erro;

require_once("app/vendor/autoload.php");

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    $oError = new Erro($e);
    $oError->setCode($e->getCode());
    $oError->setMessage($e->getMessage());
    $oError->render();
}
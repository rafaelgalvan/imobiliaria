<?php

namespace App\Model\Service;

class ResultadoValidacao
{

    private $erros = [];
    
    public function addErro($campo, $mensagem){
        $this->erros[$campo] = $mensagem;
    }

    public function getErros(){
        return $this->erros;
    }

}
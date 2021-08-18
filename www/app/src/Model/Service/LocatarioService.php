<?php

namespace App\Model\Service;

use \App\Model\Service\ResultadoValidacao;
use \App\Model\Entidades\Locatario;

class LocatarioService {

    public function validar(Locatario $locatario)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($locatario->getNome())) {
            $resultadoValidacao->addErro('locatario_nome',"Nome: Este campo não pode ser vazio");
        }

        if (empty($locatario->getEmail())) {
            $resultadoValidacao->addErro('locatario_email',"E-mail: Este campo não pode ser vazio");
        }
        
        if (empty($locatario->getTelefone())) {
            $resultadoValidacao->addErro('locatario_telefone',"Telefone: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}
<?php

namespace App\Model\Service;

use \App\Model\Service\ResultadoValidacao;
use \App\Model\Entidades\Locador;

class LocadorService {

    public function validar(Locador $locador)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($locador->getNome())) {
            $resultadoValidacao->addErro('locador_nome',"Nome: Este campo não pode ser vazio");
        }

        if (empty($locador->getEmail())) {
            $resultadoValidacao->addErro('locador_email',"E-mail: Este campo não pode ser vazio");
        }
        
        if (empty($locador->getTelefone())) {
            $resultadoValidacao->addErro('locador_telefone',"Telefone: Este campo não pode ser vazio");
        }
        
        if (empty($locador->getDiaRepasse())) {
            $resultadoValidacao->addErro('locador_dia_repasse',"Dia para Repasse: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}
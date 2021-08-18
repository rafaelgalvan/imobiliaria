<?php

namespace App\Model\Service;

use \App\Model\Service\ResultadoValidacao;
use \App\Model\Entidades\Imovel;

class ImovelService {

    public function validar(Imovel $imovel)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($imovel->getLocador()->getId())) {
            $resultadoValidacao->addErro('locador_id',"Locador: Este campo não pode ser vazio");
        }

        if (empty($imovel->getRuaEndereco())) {
            $resultadoValidacao->addErro('imovel_rua',"Rua: Este campo não pode ser vazio");
        }
        
        if (empty($imovel->getNumeroEndereco())) {
            $resultadoValidacao->addErro('imovel_numero',"Número: Este campo não pode ser vazio");
        }

        if (empty($imovel->getComplementoEndereco())) {
            $resultadoValidacao->addErro('imovel_complemento',"Complemento: Este campo não pode ser vazio");
        }

        if (empty($imovel->getBairroEndereco())) {
            $resultadoValidacao->addErro('imovel_bairro',"Bairro: Este campo não pode ser vazio");
        }

        if (empty($imovel->getCidadeEndereco())) {
            $resultadoValidacao->addErro('imovel_cidade',"Cidade: Este campo não pode ser vazio");
        }
        
        if (empty($imovel->getUfEndereco())) {
            $resultadoValidacao->addErro('imovel_uf',"Estado: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }

    public function validarEdicao(Imovel $imovel)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($imovel->getLocador()->getId())) {
            $resultadoValidacao->addErro('locador_id',"Locador: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}
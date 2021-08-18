<?php

namespace App\Model\Service;

use \App\Model\Service\ResultadoValidacao;
use \App\Model\Entidades\Contrato;
use DateTime;

class ContratoService {

    public function validar(Contrato $contrato)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($contrato->getImovel()->getId())) {
            $resultadoValidacao->addErro('imovel_id',"Imóvel: Este campo não pode ser vazio");
        }

        if (empty($contrato->getLocador()->getId())) {
            $resultadoValidacao->addErro('locador_id',"Locador: Este campo não pode ser vazio");
        }
        
        if (empty($contrato->getLocatario()->getId())) {
            $resultadoValidacao->addErro('locatario_id',"Locatário: Este campo não pode ser vazio");
        }

        if (empty($contrato->getDataInicio())) {
            $resultadoValidacao->addErro('data_inicio',"Data Início: Este campo não pode ser vazio");
        }

        if (empty($contrato->getDataTermino())) {
            $resultadoValidacao->addErro('data_termino',"Data Término: Este campo não pode ser vazio");
        }

        if (empty($contrato->getTaxaAdministracao())) {
            $resultadoValidacao->addErro('taxa_administracao',"Taxa de Administração: Este campo não pode ser vazio");
        }
        
        if (empty($contrato->getValorAluguel())) {
            $resultadoValidacao->addErro('valor_aluguel',"Valor do Aluguel: Este campo não pode ser vazio");
        }
        
        if (empty($contrato->getValorCondominio())) {
            $resultadoValidacao->addErro('valor_condominio',"Valor do Condomínio: Este campo não pode ser vazio");
        }

        if (empty($contrato->getValorIptu())) {
            $resultadoValidacao->addErro('valor_iptu',"Valor do IPTU: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }

    public function contarMesesEntreDatas($primeiraData, $segundaData): int
    {
        $d1 = new DateTime($primeiraData); 
        $d2 = new DateTime($segundaData);                                  
        $Months = $d2->diff($d1); 
        return (($Months->y) * 12) + ($Months->m);
    }
}
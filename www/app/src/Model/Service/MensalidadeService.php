<?php

namespace App\Model\Service;

use App\Model\DAO\MensalidadeDAO;
use App\Model\Entidades\Contrato;
use \App\Model\Entidades\Mensalidade;
use \App\Model\Service\ResultadoValidacao;

class MensalidadeService {

    public function validar(Mensalidade $mensalidade)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($mensalidade->isFlPago())) {
            $resultadoValidacao->addErro('fl_pagamento',"O checkbox referente ao pagamento precisa ser marcado.");
        }

        return $resultadoValidacao;
    }

    public function gerarMensalidades(Contrato $contrato)
    {
        $quantidadeMeses = 12;
        $mensalidadeDAO = new MensalidadeDAO();

        $diaInicio = date('d', strtotime($contrato->getDataInicio()));

        $valorMensalidade = $contrato->getValorAluguel() + $contrato->getValorCondominio() + $contrato->getValorIptu();
        $valorRepasse = $contrato->getValorAluguel() + $contrato->getValorIptu();
        $valorRepasseComDesconto = $valorRepasse - ($valorRepasse * ($contrato->getTaxaAdministracao() / 100));
    
        // Grava as mensalidades
        for ($i = 0; $i < $quantidadeMeses; $i++) {
            $mensalidade = new Mensalidade();
            $mensalidade->getContrato()->setId($contrato->getId());
            $mensalidade->setNumeroMensalidade($i + 1);

            if ($i === 0) {
                if ($diaInicio > 1) {
                    $valorMensalidadePrimeiroMes = ($valorMensalidade / 30) * $diaInicio;
                    $mensalidade->setValorMensalidade($valorMensalidadePrimeiroMes);
                }
            } else {
                $mensalidade->setValorMensalidade($valorMensalidade);
            }

            $mensalidadeDAO->salvar($mensalidade);
        }
    }
}
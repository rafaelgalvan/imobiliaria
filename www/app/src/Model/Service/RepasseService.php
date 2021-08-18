<?php

namespace App\Model\Service;

use App\Model\DAO\MensalidadeDAO;
use App\Model\DAO\RepasseDAO;
use App\Model\Entidades\Contrato;
use \App\Model\Entidades\Repasse;
use \App\Model\Service\ResultadoValidacao;

class RepasseService
{
    public function validar(Repasse $repasse)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if (empty($repasse->isRepassado())) {
            $resultadoValidacao->addErro('fl_repasse',"O checkbox referente ao repasse precisa ser marcado.");
        }

        return $resultadoValidacao;
    }

    public function gerarRepasses(Contrato $contrato)
    {
        $repasseDAO = new RepasseDAO();

        $mensalidadeDAO = new MensalidadeDAO();
        $mensalidades = $mensalidadeDAO->listar($contrato->getId());

        foreach ($mensalidades as $mensalidade) {
            $repasse = new Repasse();
            $repasse->getMensalidade()->setId($mensalidade->getId());
            $repasse->setValorRepasse(($mensalidade->getValorMensalidade() - $contrato->getValorCondominio()));
            $repasse->setValorRepasse($repasse->getValorRepasse() - ($repasse->getValorRepasse()  * ($contrato->getTaxaAdministracao() / 100)));

            $repasseDAO->salvar($repasse);
        }
    }
}
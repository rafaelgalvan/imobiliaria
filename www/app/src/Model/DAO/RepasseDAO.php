<?php

namespace App\Model\DAO;

use App\Model\Entidades\Repasse;
use Exception;

class RepasseDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT r.id as idRepasse,
                    r.mensalidade_id as idMensalidade,
                    m.contrato_id as idContrato,
                    m.nm_mensalidade as numeroMensalidade,
                    r.valor_repasse as valorRepasse, 
                    r.fl_repassado as repassado
             FROM repasse as r
             INNER JOIN mensalidade as m on m.id = r.mensalidade_id
             WHERE r.id = $id"
        );

        $dataSetRepasses = $resultado->fetch();

        if ($dataSetRepasses) {
            $Repasse = new Repasse();
            $Repasse->setId($dataSetRepasses['idRepasse']);
            $Repasse->getMensalidade()->setId($dataSetRepasses['idMensalidade']);
            $Repasse->getMensalidade()->getContrato()->setId($dataSetRepasses['idContrato']);
            $Repasse->getMensalidade()->setNumeroMensalidade($dataSetRepasses['numeroMensalidade']);
            $Repasse->setValorRepasse($dataSetRepasses['valorRepasse']);
            $Repasse->setRepassado($dataSetRepasses['repassado']);

            return $Repasse;
        }

        return false;
    }

    public  function listar($contrato_id)
    {
        $resultado = $this->select(
            'SELECT r.id as idRepasse,
                    r.mensalidade_id as idMensalidade,
                    m.nm_mensalidade as numeroMensalidade,
                    m.contrato_id as idContrato,
                    r.valor_repasse as valorRepasse, 
                    r.fl_repassado as repassado
             FROM repasse as r
             INNER JOIN mensalidade as m on r.mensalidade_id = m.id
             WHERE m.contrato_id = ' . $contrato_id
        );
        $dataSetRepasses = $resultado->fetchAll();

        if ($dataSetRepasses) {
            $listaRepasses = [];

            foreach ($dataSetRepasses as $dataSetRepasse) {
                
                $Repasse = new Repasse();
                $Repasse->setId($dataSetRepasse['idRepasse']);
                $Repasse->getMensalidade()->setId($dataSetRepasse['idMensalidade']);
                $Repasse->getMensalidade()->setNumeroMensalidade($dataSetRepasse['numeroMensalidade']);
                $Repasse->getMensalidade()->getContrato()->setId($dataSetRepasse['idContrato']);
                $Repasse->setValorRepasse($dataSetRepasse['valorRepasse']);
                $Repasse->setRepassado($dataSetRepasse['repassado']);

                $listaRepasses[] = $Repasse;
            }

            return $listaRepasses;
        }

        return false;
    }

    public function listarPorContrato($contrato)
    {
        $resultado = $this->select(
            'SELECT r.id as idRepasse,
                    r.mensalidade_id as idMensalidade,
                    r.valor_repasse as valorRepasse, 
                    r.fl_repassado as repassado
             FROM repasse as r
             WHERE r.contrato_id = ' . $contrato->getId()
        );
        $dataSetRepasses = $resultado->fetchAll();

        if ($dataSetRepasses) {

            $listaRepasses = [];

            foreach ($dataSetRepasses as $dataSetRepasse) {
                $Repasse = new Repasse();
                $Repasse->setId($dataSetRepasse['idRepasse']);
                $Repasse->getMensalidade()->setId($dataSetRepasse['idMensalidade']);
                $Repasse->setValorRepasse($dataSetRepasse['valorRepasse']);
                $Repasse->setRepassado($dataSetRepasse['repassado']);

                $listaRepasses[] = $Repasse;
            }

            return $listaRepasses;
        }
    }

    public function salvar(Repasse $repasse) 
    {
        try {
            $mensalidade_id = $repasse->getMensalidade()->getId();
            $valor_repasse  = $repasse->getValorRepasse();

            return $this->insert(
                'repasse',
                ":mensalidade_id,:valor_repasse",
                [
                    ':mensalidade_id'=>$mensalidade_id,
                    ':valor_repasse'=>$valor_repasse,
                ]
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Repasse $repasse) 
    {
        try {

            $id        = $repasse->getId();
            $repassado = $repasse->isRepassado();

            return $this->update(
                'repasse',
                "fl_repassado = :fl_repassado",
                [
                    ':fl_repassado'=>$repassado,
                ],
                'id = ' . $id
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Repasse $repasse)
    {
        try {
            $id = $repasse->getId();

            return $this->delete('repasse',"id = $id");

        } catch (Exception $e){

            throw new Exception('Erro ao excluir', 500);
        }
    }
}
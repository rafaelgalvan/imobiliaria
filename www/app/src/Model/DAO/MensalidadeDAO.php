<?php

namespace App\Model\DAO;

use App\Model\Entidades\Mensalidade;
use Exception;

class MensalidadeDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT m.id as idMensalidade,
                    m.contrato_id as idContrato,
                    m.nm_mensalidade as numeroMensalidade, 
                    m.fl_pago as flPago, 
                    m.vl_mensalidade as valorMensalidade
             FROM mensalidade as m
             WHERE m.id = $id"
        );

        $dataSetMensalidade = $resultado->fetch();

        if ($dataSetMensalidade) {
            $Mensalidade = new Mensalidade();
            $Mensalidade->setId($dataSetMensalidade['idMensalidade']);
            $Mensalidade->getContrato()->setId($dataSetMensalidade['idContrato']);
            $Mensalidade->setNumeroMensalidade($dataSetMensalidade['numeroMensalidade']);
            $Mensalidade->setFlPago($dataSetMensalidade['flPago']);
            $Mensalidade->setValorMensalidade($dataSetMensalidade['valorMensalidade']);

            return $Mensalidade;
        }

        return false;
    }

    public function listar($contrato_id)
    {
        $resultado = $this->select(
            'SELECT m.id as idMensalidade,
                    m.contrato_id as idContrato,
                    m.nm_mensalidade as numeroMensalidade, 
                    m.fl_pago as flPago, 
                    m.vl_mensalidade as valorMensalidade
                FROM mensalidade as m
                WHERE m.contrato_id = ' . $contrato_id
        );

        $dataSetMensalidades = $resultado->fetchAll();

        if ($dataSetMensalidades) {

            $listaMensalidades = [];

            foreach ($dataSetMensalidades as $dataSetMensalidade) {
                $Mensalidade = new Mensalidade();
                $Mensalidade->setId($dataSetMensalidade['idMensalidade']);
                $Mensalidade->getContrato()->setId($dataSetMensalidade['idContrato']);
                $Mensalidade->setNumeroMensalidade($dataSetMensalidade['numeroMensalidade']);
                $Mensalidade->setFlPago($dataSetMensalidade['flPago']);
                $Mensalidade->setValorMensalidade($dataSetMensalidade['valorMensalidade']);

                $listaMensalidades[] = $Mensalidade;
            }

            return $listaMensalidades;
        }

        return false;
    }

    public function salvar(Mensalidade $mensalidade) 
    {
        try {
            $contrato_id    = $mensalidade->getContrato()->getId();
            $nm_mensalidade = $mensalidade->getNumeroMensalidade();
            $vl_mensalidade = $mensalidade->getValorMensalidade();

            return $this->insert(
                'mensalidade',
                ":contrato_id,:nm_mensalidade,:vl_mensalidade",
                [
                    ':contrato_id'      => $contrato_id,
                    ':nm_mensalidade'   => $nm_mensalidade,
                    ':vl_mensalidade'   => $vl_mensalidade,
                ]
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Mensalidade $mensalidade) 
    {
        try {
            $id      = $mensalidade->getId();
            $fl_pago = $mensalidade->isFlPago();

            return $this->update(
                'mensalidade',
                "fl_pago = :fl_pago",
                [
                    ':fl_pago' => $fl_pago,
                ],
                "id = " . $id
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Mensalidade $mensalidade)
    {
        try {
            $id = $mensalidade->getId();

            return $this->delete('mensalidade',"id = $id");

        }catch (Exception $e){

            throw new Exception('Erro ao excluir', 500);
        }
    }
}
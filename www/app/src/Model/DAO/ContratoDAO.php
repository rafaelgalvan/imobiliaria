<?php

namespace App\Model\DAO;

use Exception;
use App\Model\Entidades\Contrato;

class ContratoDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT c.id as idContrato,
                    i.id as idImovel,
                    l.id as idLocador,
                    l.nome as nomeLocador, 
                    lo.id as idLocatario,
                    lo.nome as nomeLocatario,
                    c.dt_inicio as dataInicio, 
                    c.dt_termino as dataTermino, 
                    c.tx_administracao as taxaAdministracao,
                    c.vl_aluguel as valorAluguel,
                    c.vl_condominio as valorCondominio,
                    c.vl_iptu as valorIptu
             FROM contrato as c
             INNER JOIN imovel as i ON c.imovel_id = i.id
             INNER JOIN locador as l ON c.locador_id = l.id
             INNER JOIN locatario as lo ON c.locatario_id = lo.id
             WHERE c.id = $id"
        );

        $dataSetContrato = $resultado->fetch();

        if ($dataSetContrato) {
            $Contrato = new Contrato();
            $Contrato->setId($dataSetContrato['idContrato']);
            $Contrato->getImovel()->setId($dataSetContrato['idImovel']);
            $Contrato->getLocador()->setId($dataSetContrato['idLocador']);
            $Contrato->getLocador()->setNome($dataSetContrato['nomeLocador']);
            $Contrato->getLocatario()->setId($dataSetContrato['idLocatario']);
            $Contrato->getLocatario()->setNome($dataSetContrato['nomeLocatario']);
            $Contrato->setDataInicio($dataSetContrato['dataInicio']);
            $Contrato->setDataTermino($dataSetContrato['dataTermino']);
            $Contrato->setTaxaAdministracao($dataSetContrato['taxaAdministracao']);
            $Contrato->setValorAluguel($dataSetContrato['valorAluguel']);
            $Contrato->setValorCondominio($dataSetContrato['valorCondominio']);
            $Contrato->setValorIptu($dataSetContrato['valorIptu']);

            return $Contrato;
        }

        return false;
    }

    public function listar()
    {
            $resultado = $this->select(
                'SELECT c.id as idContrato,
                        i.id as idImovel,
                        l.nome as nomeLocador,
                        lo.nome as nomeLocatario,
                        c.dt_inicio as dataInicio,
                        c.dt_termino as dataTermino
                 FROM contrato as c
                 INNER JOIN imovel as i ON c.imovel_id = i.id
                 INNER JOIN locador as l ON c.locador_id = l.id
                 INNER JOIN locatario as lo ON c.locatario_id = lo.id'
            );
            $dataSetContratos = $resultado->fetchAll();

            if ($dataSetContratos) {

                $listaContratos = [];

                foreach ($dataSetContratos as $dataSetContrato) {
                    $Contrato = new Contrato();
                    $Contrato->setId($dataSetContrato['idContrato']);
                    $Contrato->getImovel()->setId($dataSetContrato['idImovel']);
                    $Contrato->getLocador()->setNome($dataSetContrato['nomeLocador']);
                    $Contrato->getLocatario()->setNome($dataSetContrato['nomeLocatario']);
                    $Contrato->setDataInicio($dataSetContrato['dataInicio']);
                    $Contrato->setDataTermino($dataSetContrato['dataTermino']);

                    $listaContratos[] = $Contrato;
                }

                return $listaContratos;
            }

        return false;
    }

    public function salvar(Contrato $contrato) 
    {
        try {
            $imovel_id          = $contrato->getImovel()->getId();
            $locador_id         = $contrato->getLocador()->getId();
            $locatario_id       = $contrato->getLocatario()->getId();
            $dt_inicio          = $contrato->getDataInicio();
            $dt_termino         = $contrato->getDataTermino();
            $tx_administracao   = $contrato->getTaxaAdministracao();
            $vl_aluguel         = $contrato->getValorAluguel();
            $vl_condominio      = $contrato->getValorCondominio();
            $vl_iptu            = $contrato->getValorIptu();

            return $this->insert(
                'contrato',
                ":imovel_id,
                 :locador_id,
                 :locatario_id,
                 :dt_inicio,
                 :dt_termino,
                 :tx_administracao,
                 :vl_aluguel,
                 :vl_condominio,
                 :vl_iptu
                ",
                [
                    ':imovel_id'        => $imovel_id,
                    ':locador_id'       => $locador_id,
                    ':locatario_id'     => $locatario_id,
                    ':dt_inicio'        => $dt_inicio,
                    ':dt_termino'       => $dt_termino,
                    ':tx_administracao' => $tx_administracao,
                    ':vl_aluguel'       => $vl_aluguel,
                    ':vl_condominio'    => $vl_condominio,
                    ':vl_iptu'          => $vl_iptu,
                ]
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Contrato $contrato) 
    {
        try {
            $id                 = $contrato->getId();
            $imovel_id          = $contrato->getImovel()->getId();
            $locador_id         = $contrato->getLocador()->getId();
            $locatario_id       = $contrato->getLocatario()->getId();
            $dt_inicio          = $contrato->getDataInicio();
            $dt_termino         = $contrato->getDataTermino();
            $tx_administracao   = $contrato->getTaxaAdministracao();
            $vl_aluguel         = $contrato->getValorAluguel();
            $vl_condominio      = $contrato->getValorCondominio();
            $vl_iptu            = $contrato->getValorIptu();

            return $this->update(
                'contrato',
                ":imovel_id,
                 :locador_id,
                 :locatario_id,
                 :dt_inicio,
                 :dt_termino,
                 :tx_administracao,
                 :vl_aluguel,
                 :vl_condominio,
                 :vl_iptu
                ",
                [
                    ':imovel_id'        => $imovel_id,
                    ':locador_id'       => $locador_id,
                    ':locatario_id'     => $locatario_id,
                    ':dt_inicio'        => $dt_inicio,
                    ':dt_termino'       => $dt_termino,
                    ':tx_administracao' => $tx_administracao,
                    ':vl_aluguel'       => $vl_aluguel,
                    ':vl_condominio'    => $vl_condominio,
                    ':vl_iptu'          => $vl_iptu,
                ],
                "id = " . $id
            );

        }catch (Exception $e){
            throw new Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Contrato $contrato)
    {
        try {
            $id = $contrato->getId();

            return $this->delete('contrato',"id = $id");

        }catch (Exception $e){

            throw new Exception('Erro ao excluir', 500);
        }
    }
}
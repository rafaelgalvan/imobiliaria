<?php

namespace App\Model\DAO;

use Exception;
use App\Model\Entidades\Imovel;

class ImovelDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT i.id as idImovel,
                    l.id as idLocador,
                    l.nome as nomeLocador,
                    i.end_rua as ruaEndereco, 
                    i.end_numero as numeroEndereco, 
                    i.end_complemento as complementoEndereco, 
                    i.end_bairro as bairroEndereco, 
                    i.end_cidade as cidadeEndereco, 
                    i.end_uf as ufEndereco
             FROM imovel as i
             INNER JOIN locador as l ON i.locador_id = l.id
             WHERE i.id = $id"
        );

        $dataSetImovel = $resultado->fetch();

        if ($dataSetImovel) {
            $Imovel = new Imovel();
            $Imovel->setId($dataSetImovel['idImovel']);
            $Imovel->getLocador()->setId($dataSetImovel['idLocador']);
            $Imovel->getLocador()->setNome($dataSetImovel['nomeLocador']);
            $Imovel->setRuaEndereco($dataSetImovel['ruaEndereco']);
            $Imovel->setNumeroEndereco($dataSetImovel['numeroEndereco']);
            $Imovel->setComplementoEndereco($dataSetImovel['complementoEndereco']);
            $Imovel->setBairroEndereco($dataSetImovel['bairroEndereco']);
            $Imovel->setCidadeEndereco($dataSetImovel['cidadeEndereco']);
            $Imovel->setUfEndereco($dataSetImovel['ufEndereco']);

            return $Imovel;
        }

        return false;
    }

    public function getQuantidadeContratos($id)
    {
        if ($id) {
            $resultado = $this->select(
                "SELECT count(*) as total FROM contrato WHERE imovel_id = $id"
            );

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public function listar()
    {
            $resultado = $this->select(
                'SELECT i.id as idImovel,
                        l.id as idLocador,
                        l.nome as nomeLocador, 
                        i.end_bairro as bairroEndereco, 
                        i.end_cidade as cidadeEndereco, 
                        i.end_uf as ufEndereco 
                 FROM imovel as i
                 INNER JOIN locador as l ON i.locador_id = l.id'
            );
            $dataSetImoveis = $resultado->fetchAll();

            if($dataSetImoveis) {

                $listaImoveis = [];

                foreach ($dataSetImoveis as $dataSetImovel) {
                    $Imovel = new Imovel();
                    $Imovel->setId($dataSetImovel['idImovel']);
                    $Imovel->getLocador()->setId($dataSetImovel['idLocador']);
                    $Imovel->getLocador()->setNome($dataSetImovel['nomeLocador']);
                    $Imovel->setBairroEndereco($dataSetImovel['bairroEndereco']);
                    $Imovel->setCidadeEndereco($dataSetImovel['cidadeEndereco']);
                    $Imovel->setUfEndereco($dataSetImovel['ufEndereco']);;

                    $listaImoveis[] = $Imovel;
                }

                return $listaImoveis;
            }

        return false;
    }

    public function salvar(Imovel $imovel) 
    {
        try {
            $locador_id             = $imovel->getLocador()->getId();
            $ruaEndereco            = $imovel->getRuaEndereco();
            $numeroEndereco         = $imovel->getNumeroEndereco();
            $complementoEndereco    = $imovel->getComplementoEndereco();
            $bairroEndereco         = $imovel->getBairroEndereco();
            $cidadeEndereco         = $imovel->getCidadeEndereco();
            $ufEndereco             = $imovel->getUfEndereco();

            return $this->insert(
                'imovel',
                ":locador_id,
                 :end_rua,
                 :end_numero,
                 :end_complemento,
                 :end_bairro,
                 :end_cidade,
                 :end_uf
                ",
                [
                    ':locador_id'       => $locador_id,
                    ':end_rua'          => $ruaEndereco,
                    ':end_numero'       => $numeroEndereco,
                    ':end_complemento'  => $complementoEndereco,
                    ':end_bairro'       => $bairroEndereco,
                    ':end_cidade'       => $cidadeEndereco,
                    ':end_uf'           => $ufEndereco,
                ]
            );

        }catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Imovel $imovel) 
    {
        try {
            $id         = $imovel->getId();
            $locador_id = $imovel->getLocador()->getId();

            return $this->update(
                'imovel',
                "locador_id = :locador_id",
                [
                    ':locador_id'   => $locador_id,
                ],
                "id = " . $id
            );

        } catch (Exception $e){
            throw new Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Imovel $imovel)
    {
        try {
            $id = $imovel->getId();

            return $this->delete('imovel',"id = $id");

        }catch (Exception $e){

            throw new Exception('Erro ao excluir', 500);
        }
    }
}
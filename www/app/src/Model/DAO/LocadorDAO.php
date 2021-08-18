<?php

namespace App\Model\DAO;

use Exception;
use App\Model\Entidades\Locador;

class LocadorDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT l.id as idLocador,
                    l.nome as nomeLocador, 
                    l.email as emailLocador, 
                    l.telefone as telefoneLocador, 
                    l.dia_repasse as diaRepasse
             FROM locador as l
             WHERE l.id = $id"
        );

        $dataSetLocador = $resultado->fetch();

        if ($dataSetLocador) {
            $Locador = new Locador();
            $Locador->setId($dataSetLocador['idLocador']);
            $Locador->setNome($dataSetLocador['nomeLocador']);
            $Locador->setEmail($dataSetLocador['emailLocador']);
            $Locador->setTelefone($dataSetLocador['telefoneLocador']);
            $Locador->setDiaRepasse($dataSetLocador['diaRepasse']);

            return $Locador;
        }

        return false;
    }

    public function getByContratoId($id)
    {
        $resultado = $this->select(
            "SELECT l.id as idLocador,
                    l.nome as nomeLocador, 
                    l.email as emailLocador, 
                    l.telefone as telefoneLocador, 
                    l.dia_repasse as diaRepasse
             FROM locador as l
             INNER JOIN contrato as c on c.locador_id = l.id
             WHERE c.id = $id"
        );

        $dataSetLocador = $resultado->fetch();

        if ($dataSetLocador) {
            $Locador = new Locador();
            $Locador->setId($dataSetLocador['idLocador']);
            $Locador->setNome($dataSetLocador['nomeLocador']);
            $Locador->setEmail($dataSetLocador['emailLocador']);
            $Locador->setTelefone($dataSetLocador['telefoneLocador']);
            $Locador->setDiaRepasse($dataSetLocador['diaRepasse']);

            return $Locador;
        }

        return false;
    }

    public function getQuantidadeContratos($id)
    {
        if ($id) {
            $resultado = $this->select(
                "SELECT count(*) as total FROM contrato WHERE locador_id = $id"
            );

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public function listar()
    {
            $resultado = $this->select(
                'SELECT l.id as idLocador, 
                        l.nome as nomeLocador, 
                        l.email as emailLocador, 
                        l.telefone as telefoneLocador, 
                        l.dia_repasse as diaRepasse 
                 FROM locador as l'
            );
            $dataSetLocadores = $resultado->fetchAll();

            if ($dataSetLocadores) {

                $listaLocadores = [];

                foreach ($dataSetLocadores as $dataSetLocador) {
                    $Locador = new Locador();
                    $Locador->setId($dataSetLocador['idLocador']);
                    $Locador->setNome($dataSetLocador['nomeLocador']);
                    $Locador->setEmail($dataSetLocador['emailLocador']);
                    $Locador->setTelefone($dataSetLocador['telefoneLocador']);
                    $Locador->setDiaRepasse($dataSetLocador['diaRepasse']);

                    $listaLocadores[] = $Locador;
                }

                return $listaLocadores;
            }

        return false;
    }

    public function salvar(Locador $locador) 
    {
        try {
            $nome           = $locador->getNome();
            $email          = $locador->getEmail();
            $telefone       = $locador->getTelefone();
            $dia_repasse    = $locador->getDiaRepasse();

            return $this->insert(
                'locador',
                ":nome,:email,:telefone,:dia_repasse",
                [
                    ':nome'         => $nome,
                    ':email'        => $email,
                    ':telefone'     => $telefone,
                    ':dia_repasse'  => $dia_repasse,
                ]
            );

        }catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Locador $locador) 
    {
        try {
            $id             = $locador->getId();
            $nome           = $locador->getNome();
            $email          = $locador->getEmail();
            $telefone       = $locador->getTelefone();
            $dia_repasse    = $locador->getDiaRepasse();

            return $this->update(
                'locador',
                "nome = :nome, email = :email, telefone = :telefone, dia_repasse = :dia_repasse",
                [
                    ':nome'         => $nome,
                    ':email'        => $email,
                    ':telefone'     => $telefone,
                    ':dia_repasse'  => $dia_repasse,
                ],
                "id = " . $id
            );

        }catch (Exception $e){
            throw new Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Locador $locador)
    {
        try {
            $id = $locador->getId();

            return $this->delete('locador',"id = $id");

        }catch (Exception $e){

            throw new Exception('Erro ao excluir', 500);
        }
    }
}
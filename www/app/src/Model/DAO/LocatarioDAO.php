<?php

namespace App\Model\DAO;

use Exception;
use App\Model\Entidades\Locatario;

class LocatarioDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT lo.id as idLocatario,
                    lo.nome as nomeLocatario, 
                    lo.email as emailLocatario, 
                    lo.telefone as telefoneLocatario
             FROM locatario as lo
             WHERE lo.id = $id"
        );

        $dataSetLocatario = $resultado->fetch();

        if ($dataSetLocatario) {
            $Locatario = new Locatario();
            $Locatario->setId($dataSetLocatario['idLocatario']);
            $Locatario->setNome($dataSetLocatario['nomeLocatario']);
            $Locatario->setEmail($dataSetLocatario['emailLocatario']);
            $Locatario->setTelefone($dataSetLocatario['telefoneLocatario']);

            return $Locatario;
        }

        return false;
    }

    public function getQuantidadeContratos($id)
    {
        if ($id) {
            $resultado = $this->select(
                "SELECT count(*) as total FROM contrato WHERE locatario_id = $id"
            );

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public function listar()
    {
            $resultado = $this->select(
                'SELECT lo.id as idLocatario, 
                        lo.nome as nomeLocatario, 
                        lo.email as emailLocatario, 
                        lo.telefone as telefoneLocatario 
                 FROM locatario as lo'
            );
            $dataSetLocatarios = $resultado->fetchAll();

            if ($dataSetLocatarios) {

                $listaLocatarios = [];

                foreach ($dataSetLocatarios as $dataSetLocatario) {
                    $Locatario = new Locatario();
                    $Locatario->setId($dataSetLocatario['idLocatario']);
                    $Locatario->setNome($dataSetLocatario['nomeLocatario']);
                    $Locatario->setEmail($dataSetLocatario['emailLocatario']);
                    $Locatario->setTelefone($dataSetLocatario['telefoneLocatario']);

                    $listaLocatarios[] = $Locatario;
                }

                return $listaLocatarios;
            }

        return false;
    }

    public function salvar(Locatario $locatario) 
    {
        try {
            $nome       = $locatario->getNome();
            $email      = $locatario->getEmail();
            $telefone   = $locatario->getTelefone();

            return $this->insert(
                'locatario',
                ":nome,:email,:telefone",
                [
                    ':nome'     => $nome,
                    ':email'    => $email,
                    ':telefone' => $telefone,
                ]
            );

        }catch (Exception $e){
            throw new Exception('Erro na gravação de dados.' . $e->getMessage(), 500);
        }
    }

    public function atualizar(Locatario $locatario) 
    {
        try {
            $id         = $locatario->getId();
            $nome       = $locatario->getNome();
            $email      = $locatario->getEmail();
            $telefone   = $locatario->getTelefone();

            return $this->update(
                'locatario',
                "nome = :nome, email = :email, telefone = :telefone",
                [
                    ':nome'     => $nome,
                    ':email'    => $email,
                    ':telefone' => $telefone,
                ],
                "id = " . $id
            );

        }catch (\Exception $e){
            throw new \Exception('Erro na gravação de dados.', 500);
        }
    }

    public function excluir(Locatario $locatario)
    {
        try {
            $id = $locatario->getId();

            return $this->delete('locatario',"id = $id");

        }catch (\Exception $e){

            throw new \Exception('Erro ao excluir', 500);
        }
    }
}
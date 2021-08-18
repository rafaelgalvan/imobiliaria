<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\LocadorDAO;
use App\Model\Entidades\Locador;
use App\Model\Service\LocadorService;

class LocadorController extends Controller
{
    public function index()
    {
        $locadorDAO = new LocadorDAO();

        self::setViewParam('listaLocadores',$locadorDAO->listar());

        $this->render('/locador/index');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function cadastro()
    {
        $this->render('/locador/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Locador = new Locador();
        $Locador->setNome($_POST['locador_nome']);
        $Locador->setEmail($_POST['locador_email']);
        $Locador->setTelefone($_POST['locador_telefone']);
        $Locador->setDiaRepasse($_POST['locador_dia_repasse']);

        Sessao::gravaFormulario($_POST);

        $locadorService = new LocadorService();
        $resultadoValidacao = $locadorService->validar($Locador);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/locador/cadastro');
        }

        $locadorDAO = new LocadorDAO();

        $locadorDAO->salvar($Locador);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/locador');
      
    }
    
    public function edicao($params)
    {
        $id = $params[0];

        $locadorDAO = new LocadorDAO();

        $locador = $locadorDAO->getById($id);

        if (!$locador){
            Sessao::gravaMensagem('Locador inexistente.');
            $this->redirect('/locador');
        }

        self::setViewParam('locador',$locador);

        $this->render('/locador/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $Locador = new Locador();
        $Locador->setId($_POST['id']);
        $Locador->setNome($_POST['locador_nome']);
        $Locador->setEmail($_POST['locador_email']);
        $Locador->setTelefone($_POST['locador_telefone']);
        $Locador->setDiaRepasse($_POST['locador_dia_repasse']);

        Sessao::gravaFormulario($_POST);

        $locadorService = new LocadorService();
        $resultadoValidacao = $locadorService->validar($Locador);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/locador/edicao/'.$_POST['id']);
        }

        $locadorDAO = new LocadorDAO();
        $locadorDAO->atualizar($Locador);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Locador alterado com sucesso!", "success");

        $this->redirect('/locador');

    }
    
    public function exclusao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/locador');
        }
        $id = $params[0];

        $locadorDAO = new LocadorDAO();

        $locador = $locadorDAO->getById($id);

        if (!$locador){
            Sessao::gravaMensagem('Locador inexistente.');
            $this->redirect('/locador');
        }

        self::setViewParam('locador',$locador);

        $this->render('/locador/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $Locador = new Locador();
        $Locador->setId($_POST['id']);

        $locadorDAO = new LocadorDAO();

        if ($totalContratos = $locadorDAO->getQuantidadeContratos($_POST['id'])){
            Sessao::gravaMensagem("Este locador não pode ser excluído pois existe ".$totalContratos." contrato(s) vinculados a ele.");
            $this->redirect('/locador/exclusao/'.$_POST['id']);
        }

        if (!$locadorDAO->excluir($Locador)){
            Sessao::gravaMensagem("Locador inexistente");
            $this->redirect('/locador');
        }

        Sessao::gravaMensagem("Locador excluído com sucesso!");

        $this->redirect('/locador');
    }
}
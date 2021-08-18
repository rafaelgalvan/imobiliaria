<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\LocatarioDAO;
use App\Model\Entidades\Locatario;
use App\Model\Service\LocatarioService;

class LocatarioController extends Controller
{
    public function index()
    {
        $locatarioDAO = new LocatarioDAO();

        self::setViewParam('listaLocatarios',$locatarioDAO->listar());

        $this->render('/locatario/index');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function cadastro()
    {
        $this->render('/locatario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Locatario = new Locatario();
        $Locatario->setNome($_POST['locatario_nome']);
        $Locatario->setEmail($_POST['locatario_email']);
        $Locatario->setTelefone($_POST['locatario_telefone']);

        Sessao::gravaFormulario($_POST);

        $locatarioService = new LocatarioService();
        $resultadoValidacao = $locatarioService->validar($Locatario);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/locatario/cadastro');
        }

        $locatarioDAO = new LocatarioDAO();

        $locatarioDAO->salvar($Locatario);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Locatário adicionado com sucesso!', 'success');

        $this->redirect('/locatario');
    }
    
    public function edicao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/locatario');
        }
        $id = $params[0];

        $locatarioDAO = new LocatarioDAO();

        $locatario = $locatarioDAO->getById($id);

        if (!$locatario){
            Sessao::gravaMensagem('Locatário inexistente.');
            $this->redirect('/locatario');
        }

        self::setViewParam('locatario',$locatario);

        $this->render('/locatario/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $Locatario = new Locatario();
        $Locatario->setId($_POST['id']);
        $Locatario->setNome($_POST['locatario_nome']);
        $Locatario->setEmail($_POST['locatario_email']);
        $Locatario->setTelefone($_POST['locatario_telefone']);

        Sessao::gravaFormulario($_POST);

        $locatarioService = new LocatarioService();
        $resultadoValidacao = $locatarioService->validar($Locatario);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/locatario/edicao/'.$_POST['id']);
        }

        $locatarioDAO = new LocatarioDAO();

        $locatarioDAO->atualizar($Locatario);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Locatário alterado com sucesso!', 'success');

        $this->redirect('/locatario');
    }
    
    public function exclusao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/locatario');
        }
        $id = $params[0];

        $locatarioDAO = new LocatarioDAO();

        $locatario = $locatarioDAO->getById($id);

        if (!$locatario){
            Sessao::gravaMensagem('Locatário inexistente.');
            $this->redirect('/locatario');
        }

        self::setViewParam('locatario',$locatario);

        $this->render('/locatario/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $Locatario = new Locatario();
        $Locatario->setId($_POST['id']);

        $locatarioDAO = new LocatarioDAO();

        if ($totalContratos = $locatarioDAO->getQuantidadeContratos($_POST['id'])){
            Sessao::gravaMensagem("Este locatário não pode ser excluído pois existe ".$totalContratos." contrato(s) vinculados a ele.");
            $this->redirect('/locatario/exclusao/'.$_POST['id']);
        }

        if (!$locatarioDAO->excluir($Locatario)){
            Sessao::gravaMensagem('Locatário inexistente.');
            $this->redirect('/locatario');
        }

        Sessao::gravaMensagem('Locatário excluído com sucesso!');

        $this->redirect('/locatario');
    }
}
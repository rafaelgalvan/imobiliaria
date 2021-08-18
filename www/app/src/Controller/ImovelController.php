<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\LocadorDAO;
use App\Model\DAO\ImovelDAO;
use App\Model\Entidades\Imovel;
use App\Model\Service\ImovelService;

class ImovelController extends Controller
{
    public function index()
    {
        $imovelDAO = new ImovelDAO();

        self::setViewParam('listaImoveis', $imovelDAO->listar());

        $this->render('/imovel/index');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function cadastro()
    {
        $imovelDAO  = new ImovelDAO();
        $locadorDAO = new LocadorDAO();

        self::setViewParam('listaImoveis', $imovelDAO->listar());
        self::setViewParam('listaLocadores', $locadorDAO->listar());

        $this->render('/imovel/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Imovel = new Imovel();
        $Imovel->getLocador()->setId($_POST['locador_id']);
        $Imovel->setRuaEndereco($_POST['imovel_rua']);
        $Imovel->setNumeroEndereco($_POST['imovel_numero']);
        $Imovel->setComplementoEndereco($_POST['imovel_complemento']);
        $Imovel->setBairroEndereco($_POST['imovel_bairro']);
        $Imovel->setCidadeEndereco($_POST['imovel_cidade']);
        $Imovel->setUfEndereco($_POST['imovel_uf']);

        Sessao::gravaFormulario($_POST);

        $imovelService = new ImovelService();
        $resultadoValidacao = $imovelService->validar($Imovel);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/imovel/cadastro');
        }

        $imovelDAO = new ImovelDAO();

        $imovelDAO->salvar($Imovel);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Imóvel cadastrado com sucesso!', 'success');

        $this->redirect('/imovel');
    }
    
    public function edicao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/imovel');
        }
        $id = $params[0];

        $imovelDAO = new ImovelDAO();

        $imovel = $imovelDAO->getById($id);

        if (!$imovel){
            Sessao::gravaMensagem('Imóvel inexistente.');
            $this->redirect('/imovel');
        }

        $imovelDAO  = new ImovelDAO();
        $locadorDAO = new LocadorDAO();

        self::setViewParam('listaImoveis',$imovelDAO->listar());
        self::setViewParam('listaLocadores',$locadorDAO->listar());
        self::setViewParam('imovel',$imovel);
        $this->render('/imovel/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $Imovel = new Imovel();
        $Imovel->setId($_POST['id']);
        $Imovel->getLocador()->setId($_POST['locador_id']);

        Sessao::gravaFormulario($_POST);

        $imovelService = new ImovelService();
        $resultadoValidacao = $imovelService->validarEdicao($Imovel);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/imovel/edicao/'.$_POST['id']);
        }

        $imovelDAO = new ImovelDAO();

        $imovelDAO->atualizar($Imovel);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Imóvel alterado com sucesso!', 'success');

        $this->redirect('/imovel');
    }
    
    public function exclusao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/imovel');
        }
        $id = $params[0];

        $imovelDAO = new ImovelDAO();

        $imovel = $imovelDAO->getById($id);

        if (!$imovel){
            Sessao::gravaMensagem('Imóvel inexistente.');
            $this->redirect('/imovel');
        }

        self::setViewParam('imovel',$imovel);

        $this->render('/imovel/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $Imovel = new Imovel();
        $Imovel->setId($_POST['id']);

        $imovelDAO = new ImovelDAO();

        if ($totalContratos = $imovelDAO->getQuantidadeContratos($_POST['id'])){
            Sessao::gravaMensagem('Este imóvel não pode ser excluído pois existe ' . $totalContratos . ' contrato(s) vinculados a ele.');
            $this->redirect('/imovel/exclusao/'.$_POST['id']);
        }

        if (!$imovelDAO->excluir($Imovel)){
            Sessao::gravaMensagem('Imóvel inexistente');
            $this->redirect('/imovel');
        }

        Sessao::gravaMensagem('Imóvel excluído com sucesso!');

        $this->redirect('/imovel');
    }
}
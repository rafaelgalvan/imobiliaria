<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\MensalidadeDAO;
use App\Model\Entidades\Mensalidade;
use App\Model\Service\MensalidadeService;

class MensalidadeController extends Controller
{
    public function index()
    {
        // A ser implementado...

        $this->render('/mensalidade/index');
    }

    public function cadastro()
    {
        // A ser implementado...

        $this->render('/mensalidade/cadastro');
    }

    public function salvar()
    {
        // A ser implementado...

        $this->redirect('/mensalidade');
    }
    
    public function edicao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/contrato');
        }
        
        $id = $params[0];

        $mensalidadeDAO = new MensalidadeDAO();

        $mensalidade = $mensalidadeDAO->getById($id);

        if (!$mensalidade){
            Sessao::gravaMensagem('Mensalidade inexistente.');
            $this->redirect('/mensalidade');
        }

        self::setViewParam('mensalidade',$mensalidade);
        $this->render('/mensalidade/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $Mensalidade = new Mensalidade();
        $Mensalidade->setId($_POST['id']);
        $Mensalidade->getContrato()->setId($_POST['contrato_id']);
        $Mensalidade->setFlPago(isset($_POST['fl_pagamento']) ? isset($_POST['fl_pagamento']) : 0);

        Sessao::gravaFormulario($_POST);

        $mensalidadeService = new MensalidadeService();
        $resultadoValidacao = $mensalidadeService->validar($Mensalidade);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/mensalidade/edicao/'.$_POST['id']);
        }

        $mensalidadeDAO = new MensalidadeDAO();

        $mensalidadeDAO->atualizar($Mensalidade);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Alteração realizada com sucesso!', 'success');

        $this->redirect('/mensalidade/contratomensalidade/' . $Mensalidade->getContrato()->getId());
    }

    public function contratoMensalidade($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/contrato');
        }
        $contrato_id = $params[0];
        $mensalidadeDAO = new MensalidadeDAO();

        if (!is_numeric($contrato_id)){
            Sessao::gravaMensagem('Contrato inexistente.');
            $this->redirect('/contrato');
        }

        self::setViewParam('listaMensalidades',$mensalidadeDAO->listar($contrato_id));

        $this->render('/mensalidade/contrato');

        Sessao::limpaMensagem();
    }
    
    public function exclusao($params)
    {
        // A ser implementado...

        $this->redirect('/mensalidade');
    }

    public function excluir()
    {
        // A ser implementado...

        $this->redirect('/mensalidade');
    }
}
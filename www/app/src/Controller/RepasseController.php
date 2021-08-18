<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\LocadorDAO;
use App\Model\DAO\RepasseDAO;
use App\Model\Entidades\Repasse;
use App\Model\Service\RepasseService;

class RepasseController extends Controller
{
    public function index()
    {
        // A ser implementado...

        $this->render('/repasse/index');
    }

    public function cadastro()
    {
        // A ser implementado...

        $this->render('/repasse/cadastro');
    }

    public function salvar()
    {
        // A ser implementado...

        $this->redirect('/repasse');
    }
    
    public function edicao($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/contrato');
        }
        
        $id = $params[0];

        $repasseDAO = new RepasseDAO();
        $repasse = $repasseDAO->getById($id);

        if (!$repasse){
            Sessao::gravaMensagem('Repasse inexistente.');
            $this->redirect('/repasse');
        }

        $locadorDAO = new LocadorDAO();
        self::setViewParam('locador',$locadorDAO->getByContratoId($repasse->getMensalidade()->getContrato()->getId()));

        self::setViewParam('repasse',$repasse);
        $this->render('/repasse/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $Repasse = new Repasse();
        $Repasse->setId($_POST['id']);
        $Repasse->getMensalidade()->getContrato()->setId($_POST['contrato_id']);
        $Repasse->setRepassado(isset($_POST['fl_repasse']) ? isset($_POST['fl_repasse']) : 0);

        Sessao::gravaFormulario($_POST);

        $repasseService = new RepasseService();
        $resultadoValidacao = $repasseService->validar($Repasse);

        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/repasse/edicao/'.$_POST['id']);
        }

        $repasseDAO = new RepasseDAO();
        $repasseDAO->atualizar($Repasse);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Alteração realizada com sucesso!', 'success');

        $this->redirect('/repasse/contratorepasse/' . $Repasse->getMensalidade()->getContrato()->getId());
    }

    public function contratoRepasse($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/contrato');
        }
        $contrato_id = $params[0];
        $repasseDAO = new RepasseDAO();

        if (!is_numeric($contrato_id)){
            Sessao::gravaMensagem('Contrato inexistente.');
            $this->redirect('/contrato');
        }

        
        self::setViewParam('listaRepasses',$repasseDAO->listar($contrato_id));

        $this->render('/repasse/contrato');

        Sessao::limpaMensagem();
    }
    
    public function exclusao($params)
    {
        // A ser implementado...

        $this->redirect('/repasse');
    }

    public function excluir()
    {
        // A ser implementado...

        $this->redirect('/repasse');
    }
}
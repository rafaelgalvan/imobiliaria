<?php

namespace App\Controller;

use App\Lib\Sessao;
use App\Model\DAO\ContratoDAO;
use App\Model\DAO\ImovelDAO;
use App\Model\DAO\LocatarioDAO;
use App\Model\Entidades\Contrato;
use App\Model\Service\ContratoService;
use App\Model\Service\MensalidadeService;
use App\Model\Service\RepasseService;
use DateTime;

class ContratoController extends Controller
{
    public function index()
    {
        $contratoDAO = new ContratoDAO();

        self::setViewParam('listaContratos',$contratoDAO->listar());

        $this->render('/contrato/index');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function cadastro()
    {
        $imovelDAO    = new ImovelDAO();
        $locatarioDAO = new LocatarioDAO();

        self::setViewParam('listaImoveis',$imovelDAO->listar());
        self::setViewParam('listaLocatarios',$locatarioDAO->listar());

        $this->render('/contrato/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $Contrato = new Contrato();
        $Contrato->getImovel()->setId($_POST['imovel_id']);
        $Contrato->getLocador()->setId($_POST['locador_id']);
        $Contrato->getLocatario()->setId($_POST['locatario_id']);
        $Contrato->setDataInicio($_POST['data_inicio']);
        $Contrato->setTaxaAdministracao($_POST['taxa_administracao']);
        $Contrato->setValorAluguel($_POST['valor_aluguel']);
        $Contrato->setValorCondominio($_POST['valor_condominio']);
        $Contrato->setValorIptu($_POST['valor_iptu']);

        $dataTermino = new DateTime($_POST['data_inicio']);
        $dataTermino->modify('+12 month');
        $dataTermino = $dataTermino->format('Y-m-d');

        $Contrato->setDataTermino($dataTermino);

        Sessao::gravaFormulario($_POST);

        $contratoService = new ContratoService();
        
        $resultadoValidacao = $contratoService->validar($Contrato);

        
        if ($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/contrato/cadastro');
        }
        
        $contratoDAO = new ContratoDAO();

        $contratoCriado = $contratoDAO->salvar($Contrato);
        $contratoCriado = $contratoDAO->getById($contratoCriado);

        $mensalidadeService = new MensalidadeService;
        $mensalidadeService->gerarMensalidades($contratoCriado);

        $repasseService = new RepasseService();
        $repasseService->gerarRepasses($contratoCriado);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem('Contrato cadastrado com sucesso!', 'success');

        $this->redirect('/contrato');
    }

    public function detalhe($params)
    {
        if (!is_numeric($params[0])) {
            $this->redirect('/contrato');
        }
        $id = $params[0];

        $contratoDAO = new ContratoDAO();

        $contrato = $contratoDAO->getById($id);

        if (!$contrato){
            Sessao::gravaMensagem('Contrato inexistente.');
            $this->redirect('/contrato');
        }

        self::setViewParam('contrato',$contrato);

        $this->render('/contrato/detalhe');

        Sessao::limpaMensagem();
    }
    
    public function edicao($params)
    {
        // A ser implementado...

        $this->redirect('/contrato');
    }

    public function atualizar()
    {
        // A ser implementado...

        $this->redirect('/contrato');
    }
    
    public function exclusao($params)
    {
        // A ser implementado...

        $this->redirect('/contrato');
    }

    public function excluir()
    {
        // A ser implementado...
        
        $this->redirect('/contrato');
    }
}
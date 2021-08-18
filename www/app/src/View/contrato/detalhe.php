<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Detalhe do Contrato <?php echo $viewVar['contrato']->getId();?></h3>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Locador</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['contrato']->getLocador()->getNome();?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Identificador do Imóvel</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['contrato']->getImovel()->getId();?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Locatário</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['contrato']->getLocatario()->getNome();?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data de Início</h3>
                </div>
                <div class="panel-body">
                    <?php echo date('d-m-Y', strtotime($viewVar['contrato']->getDataInicio()));?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Término</h3>
                </div>
                <div class="panel-body">
                    <?php echo date('d-m-Y', strtotime($viewVar['contrato']->getDataTermino()));?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Taxa de Administração</h3>
                </div>
                <div class="panel-body">
                    <?php echo number_format($viewVar['contrato']->getTaxaAdministracao(), 2);?> %
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valor do Aluguel</h3>
                </div>
                <div class="panel-body">
                    R$ <?php echo number_format($viewVar['contrato']->getValorAluguel(), 2, ',', '.');?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valor do Condomínio</h3>
                </div>
                <div class="panel-body">
                    R$ <?php echo number_format($viewVar['contrato']->getValorCondominio(), 2, ',', '.');?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valor do IPTU</h3>
                </div>
                <div class="panel-body">
                    R$ <?php echo number_format($viewVar['contrato']->getValorIptu(), 2, ',', '.');?>
                </div>
            </div>
            <a href="http://<?php echo APP_HOST; ?>/contrato" class="btn btn-info btn-sm">Voltar</a>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
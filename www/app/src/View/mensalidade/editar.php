<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Mensalidade</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Número do contrato</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['mensalidade']->getContrato()->getId()?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Número da mensalidade</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['mensalidade']->getNumeroMensalidade()?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valor da mensalidade</h3>
                </div>
                <div class="panel-body">
                    R$ <?php echo number_format($viewVar['mensalidade']->getValorMensalidade(), 2, ',', '.')?>
                </div>
            </div>

            <form action="http://<?php echo APP_HOST; ?>/mensalidade/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['mensalidade']->getId(); ?>">
                <input type="hidden" class="form-control" name="contrato_id" id="contrato_id" value="<?php echo $viewVar['mensalidade']->getContrato()->getId(); ?>">

                <div class="form-group">
                    <input type="checkbox" name="fl_pagamento" id="fl_pagamento" value="1" <?php echo $viewVar['mensalidade']->isFlPago() ? 'checked': '' ?>>
                    <label for="fl_pagamento">Pagamento realizado?</label>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/mensalidade/contratomensalidade/<?php echo $viewVar['mensalidade']->getContrato()->getId(); ?>" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

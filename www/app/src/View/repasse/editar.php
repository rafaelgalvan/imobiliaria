<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Repasse</h3>

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
                    <?php echo $viewVar['repasse']->getMensalidade()->getContrato()->getId()?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Número da mensalidade</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['repasse']->getMensalidade()->getNumeroMensalidade()?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Dia para repasse</h3>
                </div>
                <div class="panel-body">
                    <?php echo $viewVar['locador']->getDiaRepasse();?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Valor do repasse</h3>
                </div>
                <div class="panel-body">
                    R$ <?php echo number_format($viewVar['repasse']->getValorRepasse(), 2, ',', '.')?>
                </div>
            </div>

            <form action="http://<?php echo APP_HOST; ?>/repasse/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['repasse']->getId(); ?>">
                <input type="hidden" class="form-control" name="contrato_id" id="contrato_id" value="<?php echo $viewVar['repasse']->getMensalidade()->getContrato()->getId(); ?>">
                <input type="hidden" class="form-control" name="mensalidade_id" id="mensalidade_id" value="<?php echo $viewVar['repasse']->getMensalidade()->getId(); ?>">

                <div class="form-group">
                    <input type="checkbox" name="fl_repasse" id="fl_repasse" value="1" <?php echo $viewVar['repasse']->isRepassado() ? 'checked ': '' ?> <?php echo $viewVar['repasse']->isRepassado() ? 'disabled': '' ?>>
                    <label for="fl_pagamento">Repasse realizado?</label>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/repasse/contratorepasse/<?php echo $viewVar['repasse']->getMensalidade()->getContrato()->getId(); ?>" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

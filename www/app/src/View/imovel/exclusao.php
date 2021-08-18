<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Excluir Imóvel</h3>

            <?php if ($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-<?php echo $Sessao::retornaClasse() ? $Sessao::retornaClasse() : 'warning'; ?>" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/imovel/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['imovel']->getId(); ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir o imóvel <?php echo $viewVar['imovel']->getId(); ?>, pertencente ao Locador <?php echo $viewVar['imovel']->getLocador()->getNome() ?>?
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/imovel" class="btn btn-info btn-sm">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

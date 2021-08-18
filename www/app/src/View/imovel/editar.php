<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Imóvel</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/imovel/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['imovel']->getId(); ?>">

                <div class="form-group">
                    <label for="locador_id">Locador</label>
                <select class="form-control" name="locador_id"  required>
                    <?php foreach ($viewVar['listaLocadores'] as $Locador): ?>
                    <option value="<?php echo $Locador->getId(); ?>" <?php echo ($viewVar['imovel']->getLocador()->getId() == $Locador->getId())? "selected" : ""; ?>><?php echo $Locador->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/imovel" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

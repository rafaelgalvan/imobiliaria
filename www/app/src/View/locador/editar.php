<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Locador</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/locador/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['locador']->getId(); ?>">

                <div class="form-group">
                    <label for="locador_nome">Nome</label>
                    <input type="text"  class="form-control" name="locador_nome" id="locador_nome" placeholder="Nome do Locador" value="<?php echo $viewVar['locador']->getNome(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="locador_email">E-mail</label>
                    <input type="email"  class="form-control"  name="locador_email" id="locador_email" placeholder="email@exemplo.com" value="<?php echo $viewVar['locador']->getEmail(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="locador_telefone">Telefone</label>
                    <input type="text"  class="form-control"  name="locador_telefone" id="locador_telefone" placeholder="48 999999999" value="<?php echo $viewVar['locador']->getTelefone(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="locador_dia_repasse">Dia para Repasse</label>
                    <input type="number" class="form-control" name="locador_dia_repasse" placeholder="Ex.: 15" value="<?php echo $viewVar['locador']->getDiaRepasse(); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/locador" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

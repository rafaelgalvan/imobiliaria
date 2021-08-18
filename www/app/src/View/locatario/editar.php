<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Locatário</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/locatario/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['locatario']->getId(); ?>">

                <div class="form-group">
                    <label for="locatario_nome">Nome</label>
                    <input type="text"  class="form-control" name="locatario_nome" id="locatario_nome" placeholder="Nome do Locatário" value="<?php echo $viewVar['locatario']->getNome(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="locatario_email">E-mail</label>
                    <input type="email"  class="form-control"  name="locatario_email" id="locatario_email" placeholder="email@exemplo.com" value="<?php echo $viewVar['locatario']->getEmail(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="locatario_telefone">Telefone</label>
                    <input type="text"  class="form-control"  name="locatario_telefone" id="locatario_telefone" placeholder="48 999999999" value="<?php echo $viewVar['locatario']->getTelefone(); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/locatario" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

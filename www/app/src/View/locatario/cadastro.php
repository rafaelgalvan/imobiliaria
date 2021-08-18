<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Locatário</h3>
            
            <?php if ($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/locatario/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="locatario_nome">Nome</label>
                    <input type="text" class="form-control"  name="locatario_nome" placeholder="Nome do Locatário" value="<?php echo $Sessao::retornaValorFormulario('locatario_nome'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="locatario_email">E-mail</label>
                    <input type="email" class="form-control" name="locatario_email" placeholder="email@exemplo.com" value="<?php echo $Sessao::retornaValorFormulario('locatario_email'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="locatario_telefone">Telefone</label>
                    <input type="text" class="form-control" name="locatario_telefone" placeholder="48 999999999" value="<?php echo $Sessao::retornaValorFormulario('locatario_telefone'); ?>" required>

                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
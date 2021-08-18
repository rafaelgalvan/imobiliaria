<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Imóvel</h3>
            
            <?php if ($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/imovel/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="locador_id">Locador</label>
                <select class="form-control" name="locador_id"  required>
                    <?php foreach($viewVar['listaLocadores'] as $Locador): ?>
                    <option value="<?php echo $Locador->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('locador_id') == $Locador->getId())? "selected" : ""; ?>><?php echo $Locador->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                
                <div class="form-group">
                    <label for="imovel_rua">Rua</label>
                    <input type="text" class="form-control"  name="imovel_rua" placeholder="Nome da rua" value="<?php echo $Sessao::retornaValorFormulario('imovel_rua'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="imovel_numero">Número</label>
                    <input type="number" class="form-control" name="imovel_numero" placeholder="100" value="<?php echo $Sessao::retornaValorFormulario('imovel_numero'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="imovel_complemento">Complemento</label>
                    <input type="text" class="form-control" name="imovel_complemento" placeholder="Esquina com Av. Principal" value="<?php echo $Sessao::retornaValorFormulario('imovel_complemento'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="imovel_bairro">Bairro</label>
                    <input type="text" class="form-control" name="imovel_bairro" placeholder="Nome do bairro" value="<?php echo $Sessao::retornaValorFormulario('imovel_bairro'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="imovel_cidade">Cidade</label>
                    <input type="text" class="form-control" name="imovel_cidade" placeholder="Nome da cidade/município" value="<?php echo $Sessao::retornaValorFormulario('imovel_cidade'); ?>" required>

                </div>
                <div class="form-group">
                    <label for="imovel_uf">UF</label>
                    <input type="text" class="form-control" name="imovel_uf" placeholder="SC" value="<?php echo $Sessao::retornaValorFormulario('imovel_uf'); ?>" required>

                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
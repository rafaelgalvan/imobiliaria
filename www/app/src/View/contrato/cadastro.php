<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Novo Contrato</h3>
            
            <?php if ($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/contrato/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="imovel_id">Imóvel</label>
                <select class="form-control" name="imovel_id"  required>
                    <?php foreach ($viewVar['listaImoveis'] as $imovel): ?>
                    <option value="<?php echo $imovel->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('imovel_id') == $imovel->getId())? "selected" : ""; ?>><?php echo $imovel; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <input type="hidden" class="form-control" name="locador_id" id="locador_id" value="<?php echo $imovel->getLocador()->getId(); ?>">

                <div class="form-group">
                    <label for="locatario_id">Locatário</label>
                <select class="form-control" name="locatario_id"  required>
                    <?php foreach ($viewVar['listaLocatarios'] as $Locatario): ?>
                    <option value="<?php echo $Locatario->getId(); ?>" <?php echo ($Sessao::retornaValorFormulario('locatario_id') == $Locatario->getId())? "selected" : ""; ?>><?php echo $Locatario->getNome(); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                
                <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                    <input type="date" class="form-control"  name="data_inicio" placeholder="DD/MM/AAAA" value="<?php echo $Sessao::retornaValorFormulario('data_inicio'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="taxa_administracao">Taxa de Administração</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="taxa_administracao" placeholder="1.00" value="<?php echo $Sessao::retornaValorFormulario('taxa_administracao'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="valor_aluguel">Valor do Aluguel</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="valor_aluguel" placeholder="1000,00" value="<?php echo $Sessao::retornaValorFormulario('valor_aluguel'); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="valor_condominio">Valor do Condomínio</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="valor_condominio" placeholder="100,00" value="<?php echo $Sessao::retornaValorFormulario('valor_condominio'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="valor_iptu">Valor do IPTU</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="valor_iptu" placeholder="100,00" value="<?php echo $Sessao::retornaValorFormulario('valor_iptu'); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
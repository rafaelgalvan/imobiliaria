<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/contrato/cadastro" class="btn btn-success btn-sm">Adicionar</a>
        <hr>
    </div>
    <div class="col-md-12">
        <?php if ($Sessao::retornaMensagem()){ ?>
            <div class="alert alert-<?php echo $Sessao::retornaClasse() ? $Sessao::retornaClasse() : 'warning'; ?>" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
        <?php } ?>

        <?php
            if (empty($viewVar['listaContratos'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum contrato encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Número do Contrato</td>
                        <td class="info">Código do Imóvel</td>
                        <td class="info">Locador</td>
                        <td class="info">Locatário</td>
                        <td class="info">Data Início</td>
                        <td class="info">Data Término</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach ($viewVar['listaContratos'] as $contrato) {
                    ?>
                        <tr>
                            <td><?php echo $contrato->getId(); ?></td>
                            <td><?php echo $contrato->getImovel()->getId(); ?></td>
                            <td><?php echo $contrato->getLocador()->getNome(); ?></td>
                            <td><?php echo $contrato->getLocatario()->getNome(); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($contrato->getDataInicio())); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($contrato->getDataTermino())); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/contrato/detalhe/<?php echo $contrato->getId(); ?>" class="btn btn-info btn-sm">+ Detalhes</a>
                                <a href="http://<?php echo APP_HOST; ?>/mensalidade/contratomensalidade/<?php echo $contrato->getId(); ?>" class="btn btn-primary btn-sm">Listar Mensalidades</a>
                                <a href="http://<?php echo APP_HOST; ?>/repasse/contratorepasse/<?php echo $contrato->getId(); ?>" class="btn btn-primary btn-sm">Listar Repasses</a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        <?php
            }
        ?>
    </div>
</div>
</div>
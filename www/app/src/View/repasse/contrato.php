<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <h3>Repasses pertencentes ao contrato <?php echo $viewVar['listaRepasses'][0]->getMensalidade()->getContrato()->getId();?>.</h3>
        <?php
            if(empty($viewVar['listaRepasses'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum repasse encontrada</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Número da mensalidade</td>
                        <td class="info">Valor do repasse</td>
                        <td class="info">Repasse realizado?</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach($viewVar['listaRepasses'] as $repasse) {
                    ?>
                        <tr>
                            <td><?php echo $repasse->getMensalidade()->getNumeroMensalidade(); ?></td>
                            <td>R$ <?php echo number_format($repasse->getValorRepasse(), 2, ',', '.'); ?></td>
                            <td><?php echo $repasse->isRepassado() ? 'Sim' : 'Não'; ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/repasse/edicao/<?php echo $repasse->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
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
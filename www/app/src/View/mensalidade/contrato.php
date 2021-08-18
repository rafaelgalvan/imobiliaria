<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <h3>Mensalidades pertencentes ao contrato <?php echo $viewVar['listaMensalidades'][0]->getContrato()->getId();?>.</h3>
        <?php
            if(empty($viewVar['listaMensalidades'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhuma mensalidade encontrada</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Número da mensalidade</td>
                        <td class="info">Valor da mensalidade</td>
                        <td class="info">Pagamento realizado?</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach($viewVar['listaMensalidades'] as $mensalidade) {
                    ?>
                        <tr>
                            <td><?php echo $mensalidade->getNumeroMensalidade(); ?></td>
                            <td>R$ <?php echo number_format($mensalidade->getValorMensalidade(), 2, ',', '.'); ?></td>
                            <td><?php echo $mensalidade->isFLPago() ? 'Sim' : 'Não'; ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/mensalidade/edicao/<?php echo $mensalidade->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
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
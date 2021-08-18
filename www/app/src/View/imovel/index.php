<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/imovel/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if (empty($viewVar['listaImoveis'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum imóvel encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome do Locador</td>
                        <td class="info">Bairro</td>
                        <td class="info">Cidade</td>
                        <td class="info">Estado</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach ($viewVar['listaImoveis'] as $imovel) {
                    ?>
                        <tr>
                            <td><?php echo $imovel->getLocador()->getNome(); ?></td>
                            <td><?php echo $imovel->getBairroEndereco(); ?></td>
                            <td><?php echo $imovel->getCidadeEndereco(); ?></td>
                            <td><?php echo $imovel->getUfEndereco(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/imovel/edicao/<?php echo $imovel->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/imovel/exclusao/<?php echo $imovel->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
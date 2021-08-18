<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/locador/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if (empty($viewVar['listaLocadores'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum locador encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome</td>
                        <td class="info">E-mail</td>
                        <td class="info">Dia para Repasse</td>
                        <td class="info">Telefone</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach ($viewVar['listaLocadores'] as $locador) {
                    ?>
                        <tr>
                            <td><?php echo $locador->getNome(); ?></td>
                            <td><?php echo $locador->getEmail(); ?></td>
                            <td><?php echo $locador->getDiaRepasse(); ?></td>
                            <td><?php echo $locador->getTelefone(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/locador/edicao/<?php echo $locador->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/locador/exclusao/<?php echo $locador->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
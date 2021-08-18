<div class="container">
    <div class="row">
    <br>
    <div class="col-md-12">
        <a href="http://<?php echo APP_HOST; ?>/locatario/cadastro" class="btn btn-success btn-sm">Adicionar</a>
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
            if(empty($viewVar['listaLocatarios'])){
        ?>
            <div class="alert alert-info" role="alert">Nenhum locatário encontrado</div>
        <?php
            } else {
        ?>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome</td>
                        <td class="info">E-mail</td>
                        <td class="info">Telefone</td>
                        <td class="info">Ações</td>
                    </tr>
                    <?php
                        foreach($viewVar['listaLocatarios'] as $locatario) {
                    ?>
                        <tr>
                            <td><?php echo $locatario->getNome(); ?></td>
                            <td><?php echo $locatario->getEmail(); ?></td>
                            <td><?php echo $locatario->getTelefone(); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/locatario/edicao/<?php echo $locatario->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/locatario/exclusao/<?php echo $locatario->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
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
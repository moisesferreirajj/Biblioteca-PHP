<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Usuários</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmUsuario();"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tblUsuarios">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Usuário</th>
                                <th>Nome</th>
                                <th>Situação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="novo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="title">Novo Usuário</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="frmUsuario">
                                    <div class="form-group">
                                        <label for="usuario">Usuário</label>
                                        <input type="hidden" id="id" name="id">
                                        <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuário">
                                    </div>
                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input id="nome" class="form-control" type="text" name="nome" placeholder="Nome do usuário">
                                    </div>
                                    <div class="row" id="chaves">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="chave">Senha</label>
                                                <input id="chave" class="form-control" type="password" name="chave" placeholder="Senha">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirmar">Confirmar Senha</label>
                                                <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar senha">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="button" onclick="registrarUser(event);" id="btnAccion">Voltar</button>
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="permissoes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white">Controle de permissões</h5>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="frmPermissoes">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Views/Templates/footer.php"; ?>
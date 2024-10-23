<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Autores</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmAutor()"><i class="fa fa-plus fa-2x"></i></button>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tblAutor">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Foto</th>
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
<div id="novoAutor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Cadastrar Autor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAutor" onsubmit="registrarAutor(event)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="autor">Nome</label>
                                <input type="hidden" id="id" name="id">
                                <input id="autor" class="form-control" type="text" name="autor" required placeholder="Nome do Autor" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <input type="hidden" id="foto_atual" name="foto_atual">
                                        <label for="imagem" id="icon-image" class="btn btn-primary"><i class="fa fa-cloud-upload"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagem" class="d-none" type="file" name="imagem" onchange="preview(event)">
                                        <img class="img-thumbnail" id="img-preview" width="150">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="btnAccion">Cadastrar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Voltar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
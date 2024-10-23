<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Empréstimos</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" onclick="frmPrestar()"><i class="fa fa-plus"></i></button>
<div class="tile">
    <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped mt-4" id="tblPrestar">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Livro</th>
                        <th>Estudante</th>
                        <th>Data do empréstimo</th>
                        <th>Data da devolução</th>
                        <th>Quant.</th>
                        <th>Observação</th>
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
<div id="prestar" class="modal fade" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="title">Emprestar livro</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPrestar" onsubmit="registroEmprestimo(event)">
                    <div class="form-group">
                        <label for="livro">Livro</label><br>
                        <select id="livro" class="form-control livro" name="livro" onchange="verificarLivro()" required style="width: 100%;">

                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="estudante">Estudante</label><br>
                                <select name="estudante" id="estudante" class="form-control estudante" required style="width: 100%;">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantidade">Quant.</label>
                                <input id="quantidade" class="form-control" min="1" type="number" name="quantidade" min="1" required onkeyup="verificarLivro()">
                                <strong id="msg_error"></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_emprestimo">Data do empréstimo</label>
                                <input id="fecha_emprestimo" class="form-control" type="date" name="fecha_emprestimo" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_devolucao">Data da devolução</label>
                                <input id="fecha_devolucao" class="form-control" type="date" name="fecha_devolucao" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea id="observacao" class="form-control" placeholder="Observação" name="observacao" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" id="btnAccion">Emprestar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
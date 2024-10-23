<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Dados da Empresa</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <form id="frmConfig">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nome"><i class="fa fa-address-card" aria-hidden="true"></i> Nome</label>
                                <input id="id" type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <input id="nome" class="form-control" type="text" name="nome" value="<?php echo $data['nome']; ?>" required placeholder="Nome">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="telefone"><i class="fa fa-phone-square" aria-hidden="true"></i> Telefone</label>
                                <input id="telefone" class="form-control" type="text" name="telefone" value="<?php echo $data['telefone']; ?>" required placeholder="Telefone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="endereco"><i class="fa fa-home" aria-hidden="true"></i> Endereço</label>
                                <input id="endereco" class="form-control" type="text" name="endereco" value="<?php echo $data['endereco']; ?>" required placeholder="Endereço">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email Electrónico</label>
                                <input id="email" class="form-control" type="text" name="email" value="<?php echo $data['email']; ?>" required placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-picture-o" aria-hidden="true"></i> Logo</label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <input type="hidden" id="foto_atual">
                                        <label for="imagem" id="icon-image" class="btn btn-primary"><i class="fa fa-cloud-upload"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagem" class="d-none" type="file" name="imagem" onchange="preview(event)">
                                        <img class="img-thumbnail" id="img-preview" src="<?php echo base_url; ?>Assets/img/<?php echo $data['foto']; ?>" width="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" onclick="frmConfig(event)">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
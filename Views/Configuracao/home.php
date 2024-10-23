<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Biblioteca Escolar - ONLINE!</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Usuarios">
                <h4>Usuários</h4>
                <p><b><?php echo $data['usuarios']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-book fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Livros">
                <h4>Livros</h4>
                <p><b><?php echo $data['livros']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-address-book-o fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Autor">
                <h4>Autores</h4>
                <p><b><?php echo $data['autor']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-tags fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Editora">
                <h4>Editoras</h4>
                <p><b><?php echo $data['editora']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-graduation-cap fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Estudantes">
                <h4>Estudantes</h4>
                <p><b><?php echo $data['estudantes']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-hourglass-start fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Emprestimo">
                <h4>Empréstimos</h4>
                <p><b><?php echo $data['emprestimo']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-list-alt fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Genero">
                <h4>Gêneros</h4>
                <p><b><?php echo $data['generos']['total'] ?></b></p>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-cogs fa-3x"></i>
            <a class="info" href="<?php echo base_url; ?>Configuracao">
                <h6>CONFIGURAÇÕES</h6>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Livros disponíveis</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="reporteEmprestimo"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
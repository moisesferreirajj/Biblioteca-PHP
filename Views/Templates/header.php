<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="description" content="Biblioteca escolar do Plácido Olimpio de Oliveira, Joinville SC.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Administração da Biblioteca">
    <meta property="og:title" content="Escola Plácido Olimpio de Oliveira">
    <meta property="og:description" content="Biblioteca escolar do Plácido Olimpio de Oliveira, Joinville SC.">
    <title>Plácido | Administração</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="<?php echo base_url; ?>Assets/css/main.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
	<link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="Assets/img/logo.png">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
           
    <li class="center-text">Plácido Olímpio de Oliveira</li>

             <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">Livros não devolvidos</li>
                    <div class="app-notification__content">
                        <li id="nome_estudante">
                            
                        </li>
                    </div>
                    <li class="app-notification__footer"><a href="<?php echo base_url; ?>Emprestimo/pdf" target="_blank">Gerar relatórios</a></li>
                </ul>
            </li>



            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="#" id="modalPass"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir"><i class="fa fa-sign-out fa-lg"></i> Sair</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
<img class="app-sidebar__user-avatar" src="<?php echo base_url; ?>Assets/img/logo.png" alt="User Image" width="50">
            <div>
                <p class="app-sidebar__user-name"><?php echo $_SESSION['nome'] ?></p>
                <p class="app-sidebar__user-designation">Plácido Olímpio</p>
            </div>
        </div>
        <ul class="app-menu">
		    <li><a class="app-menu__item" href="<?php echo base_url; ?>Configuracao/admin"><i class="app-menu__icon fa fa-user fa-lg"></i><span class="app-menu__label">Início</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Emprestimo"><i class="app-menu__icon fa fa-hourglass-start"></i><span class="app-menu__label">Empréstimos</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Estudantes"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Estudantes</span></a></li>
            <li><a class="app-menu__item" href="<?php echo base_url; ?>Genero"><i class="app-menu__icon fa fa-list-alt"></i><span class="app-menu__label">Gêneros</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Livros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Autor"><i class="icon fa fa-address-book-o"></i> Autores</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Editora"><i class="icon fa fa-tags"></i> Editoras</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Livros"><i class="icon fa fa-book"></i> Livros</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-wrench"></i><span class="app-menu__label">Administração</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Usuarios"><i class="icon fa fa-user-o"></i> Usuários</a></li>
                    <li><a class="treeview-item" href="<?php echo base_url; ?>Configuracao"><i class="icon fa fa-cogs"></i> Configurações</a></li>
                </ul>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Relatórios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" target="_blank" href="<?php echo base_url; ?>Emprestimo/pdf"><i class="icon fa fa-file-pdf-o"></i> Livros emprestados</a></li>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
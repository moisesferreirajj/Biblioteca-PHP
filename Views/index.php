<?php
header("Access-Control-Allow-Origin: *"); // Permite todas as origens (apenas para desenvolvimento)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="Assets/img/logo.png">
    <title>Plácido | Biblioteca</title>
</head>

<body>
    <section class="generol-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="login-box">
            <form class="login-form" id="frmLogin" onsubmit="frmLogin(event);">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>| INICIAR SESSÃO</h3>
                <div class="form-group">
                    <label class="control-label">USUÁRIO:</label>
                    <input class="form-control" type="text" placeholder="Insira seu usuário" id="usuario" name="usuario" autofocus required>
                </div>
                <div class="form-group">
                    <label class="control-label">SENHA:</label>
                    <input class="form-control" type="password" placeholder="Insira sua senha" id="chave" name="chave" required>
                </div>
                <div class="alert alert-danger d-none" role="alert" id="alerta"></div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Acessar sua conta</button>
                </div>
                <div class="form-group btn-container">
                <button class="btn btn-secondary btn-block" type="button" id="btnRegistrar"><i class="fa fa-user-plus fa-lg fa-fw"></i>Registrar Bibliotecário</button>
               </div>
          </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url; ?>Assets/js/pace.min.js"></script>
    <script>
        const base_url = '<?php echo base_url; ?>';
    </script>
    <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
    <script type="text/javascript">
document.getElementById('btnRegistrar').addEventListener('click', registrarUsuario);

function registrarUsuario() {
    let usuario = prompt("Digite o usuário:");
    let nome = prompt("Digite o nome:");
    let chave = prompt("Digite a senha:");
    let confirmar = prompt("Confirme a senha:");

    if (!usuario || !nome || !chave || !confirmar) {
        alert("Todos os campos são obrigatórios!");
        return;
    }

    $.ajax({
        url: base_url + 'Usuarios/registrar',
        type: 'POST',
        data: {
            usuario: usuario,
            nome: nome,
            chave: chave,
            confirmar: confirmar,
            id: ''
        },
        success: function(response) {
            let res = JSON.parse(response);
            alert(res.msg);
            if (res.icone === 'success' && res.redirect) {
                window.location.href = res.redirect;
            }
        },
        error: function() {
            alert("Erro ao registrar o usuário.");
        }
    });
}
    </script>
</body>

</html>

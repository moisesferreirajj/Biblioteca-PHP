<?php
header("Access-Control-Allow-Origin: *"); // Permite todas as origens (apenas para desenvolvimento)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

class Usuarios extends Controller {
    public function __construct() {
        session_start();
        parent::__construct();
    }
    
    public function index() {
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Usuarios") || $this->model->verificarPermissoes($id_user, "Admin");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permissoes");
            exit;
        }
        $this->views->getView($this, "index");
    }
    
    public function listar() {
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        $data = $this->model->getUsuarios();
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                if ($data[$i]['id'] != 1) {
                    $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                    $data[$i]['acciones'] = '<div>
                    <button class="btn btn-dark" onclick="btnRolesUser(' . $data[$i]['id'] . ')"><i class="fa fa-key"></i></button>
                    <button class="btn btn-primary" type="button" onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarUser(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                    <div/>';
                } else {
                    $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                    $data[$i]['acciones'] = '<div class"text-center">
                    <span class="badge-primary p-1 rounded">Super Administrador</span>
                    </div>'; 
                }
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarUser(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function validar() {
        $usuario = strClean($_POST['usuario']);
        $chave = strClean($_POST['chave']);
        if (empty($usuario) || empty($chave)) {
            $msg = array('msg' => 'Todos os campos são obrigatórios!', 'icone' => 'warning');
        } else {
            $hash = hash("SHA256", $chave);
            $data = $this->model->getUsuario($usuario, $hash);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nome'] = $data['nome'];
                $_SESSION['ativo'] = true;
                $msg = array('msg' => 'Processando...', 'icone' => 'success');
            } else {
                $msg = array('msg' => 'Usuário ou senha incorreta!', 'icone' => 'warning');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
public function registrar() {
    $usuario = strClean($_POST['usuario']);
    $nome = strClean($_POST['nome']);
    $chave = strClean($_POST['chave']);
    $confirmar = strClean($_POST['confirmar']);
    $id = strClean($_POST['id']);
    $hash = hash("SHA256", $chave);
    
    if (empty($usuario) || empty($nome) || empty($chave) || empty($confirmar)) {
        $msg = array('msg' => 'Todos os campos são obrigatórios!', 'icone' => 'warning');
    } else {
        if ($id == "") {
            if ($chave != $confirmar) {
                $msg = array('msg' => 'As senhas não coincidem!', 'icone' => 'warning');
            } else {
                $data = $this->model->registrarUsuario($usuario, $nome, $hash);
                if ($data == "ok") {
                    // Login automático após o registro
                    $dataLogin = $this->model->getUsuario($usuario, $hash);
                    if ($dataLogin) {
                        $_SESSION['id_usuario'] = $dataLogin['id'];
                        $_SESSION['usuario'] = $dataLogin['usuario'];
                        $_SESSION['nome'] = $dataLogin['nome'];
                        $_SESSION['ativo'] = true;
                        $msg = array('msg' => 'Usuário cadastrado e logado com sucesso!', 'icone' => 'success', 'redirect' => base_url . 'Configuracao/admin');
                    } else {
                        $msg = array('msg' => 'Erro ao logar após registro!', 'icone' => 'error');
                    }
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Este usuário já existe!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao cadastrar!', 'icone' => 'error');
                }
            }
        } else {
            $data = $this->model->modificarUsuario($usuario, $nome, $id);
            if ($data == "modificado") {
                $msg = array('msg' => 'Usuário alterado!', 'icone' => 'success');
            } else {
                $msg = array('msg' => 'Erro ao alterar!', 'icone' => 'error');
            }
        }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}
    
    public function editar(int $id) {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function eliminar(int $id) {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuário dado baixa!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao dar baixa no usuário!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function reingresar(int $id) {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Usuário restaurado!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao restaurar!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function permissoes($id) {
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "roles");
        if (!$perm && $id_user != 1) {
            echo '<div class="card">
                    <div class="card-body text-center">
                        <span class="badge badge-danger">Não tem permissão</span>
                    </div>
                </div>';
            exit;
        }
        $data = $this->model->getPermissoes();
        $asignados = $this->model->getDetallePermissoes($id);
        $dados = array();
        foreach ($asignados as $asignado) {
            $dados[$asignado['id_permissao']] = true;
        }
        echo '<div class="row">
        <input type="hidden" name="id_usuario" value="' . $id . '">';
        foreach ($data as $row) {
            echo '<div class="d-inline mx-3 text-center">
                    <hr>
                    <label for="" class="font-weight-bold text-capitalize">' . $row['nome'] . '</label>
                        <div class="center">
                            <input type="checkbox" name="permissoes[]" value="' . $row['id'] . '" ';
            if (isset($dados[$row['id']])) {
                echo "checked";
            }
            echo '>
                            <span class="span">On</span>
                            <span class="span">Off</span>
                        </div>
                </div>';
        }
        echo '</div>
        <button class="btn btn-primary mt-3 btn-block" type="button" onclick="registrarPermissoes(event);">Atualizar</button>';
        die();
    }
    
    public function registrarPermissoes() {
        $id_user = strClean($_POST['id_usuario']);
        $permissoes = $_POST['permissoes'];
        $this->model->deletePermissoes($id_user);
        if ($permissoes != "") {
            foreach ($permissoes as $permiso) {
                $this->model->atualizarPermissoes($id_user, $permiso);
            }
        }
        echo json_encode("ok");
        die();
    }
    
    public function cambiarPas() {
        if ($_POST) {
            $id = $_SESSION['id_usuario'];
            $chave = strClean($_POST['chave_atual']);
            $user = $this->model->editarUser($id);
            if (hash("SHA256", $chave) == $user['chave']) {
                $hash = hash("SHA256", strClean($_POST['chave_nova']));
                $data = $this->model->atualizarPass($hash, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Senha alterada!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar!', 'icone' => 'warning');
                }
            } else {
                $msg = array('msg' => 'Senha incorreta!', 'icone' => 'warning');
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    public function salir() {
        session_destroy();
        header("location: ".base_url);
    }
}
?>

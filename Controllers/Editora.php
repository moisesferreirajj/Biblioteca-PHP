<?php
class Editora extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Editora") || $this->model->verificarPermissoes($id_user, "Admin") || $this->model->verificarPermissoes($id_user, "Bibliotecario");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permissoes");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getEditora();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarEdi(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarEdi(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarEdi(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $editora = strClean($_POST['editora']);
        $id = strClean($_POST['id']);
        if (empty($editora)) {
            $msg = array('msg' => 'O nome é um campo requerido!', 'icone' => 'warning');
        } else {
            if ($id == "") {
                $data = $this->model->insertarEditora($editora);
                if ($data == "ok") {
                    $msg = array('msg' => 'Editora cadastrada com sucesso!', 'icone' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Essa editora já existe!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao cadastrar editora!', 'icone' => 'error');
                }
            } else {
                $data = $this->model->atualizarEditora($editora, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Editora alterada com sucesso!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar editora!', 'icone' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editEditora($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoEditora(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Editora dado baixa com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao dar baixa na editora!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoEditora(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Editora restaurada com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao restaurar editora!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarEditora()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarEditora($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}

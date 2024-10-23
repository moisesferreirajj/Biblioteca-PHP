<?php
class Genero extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Genero") || $this->model->verificarPermissoes($id_user, "Admin") || $this->model->verificarPermissoes($id_user, "Bibliotecario");
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
        $data = $this->model->getGeneros();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarMat(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarMat(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarMat(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $genero = strClean($_POST['genero']);
        $id = strClean($_POST['id']);
        if (empty($genero)) {
            $msg = array('msg' => 'O campo nome é obrigatório!', 'icone' => 'warning');
        } else {
            if ($id == "") {
                $data = $this->model->insertarGenero($genero);
                if ($data == "ok") {
                    $msg = array('msg' => 'Gênero cadastrada com sucesso!', 'icone' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Esta gênero já existe!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao cadastrar a gênero!', 'icone' => 'error');
                }
            } else {
                $data = $this->model->atualizarGenero($genero, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Gênero alterada com sucesso!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar a gênero!', 'icone' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editGenero($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoGenero(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Gênero dado baixa com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao dar baixa na gênero!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoGenero(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Gênero reingressada com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao reingressar a gênero!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarGenero()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarGenero($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}

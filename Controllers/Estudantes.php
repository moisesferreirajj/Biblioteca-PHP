<?php
class Estudantes extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Estudantes") || $this->model->verificarPermissoes($id_user, "Admin") || $this->model->verificarPermissoes($id_user, "Bibliotecario");
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
        $data = $this->model->getEstudantes();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarEst(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarEst(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarEst(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
	
public function eliminarPermanentemente($id)
{
    $data = $this->model->deleteEstudante($id);
    if ($data == 1) {
        $msg = array('msg' => 'Estudante eliminado permanentemente!', 'icone' => 'success');
    } else {
        $msg = array('msg' => 'Erro ao eliminar estudante!', 'icone' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}

    public function registrar()
    {
        $codigo = strClean($_POST['codigo']);
        $dni = strClean($_POST['dni']);
        $nome = strClean($_POST['nome']);
        $turma = strClean($_POST['turma']);
        $endereco = strClean($_POST['endereco']);
        $telefone = strClean($_POST['telefone']);
        $id = strClean($_POST['id']);
        if (empty($codigo) || empty($dni) || empty($nome) || empty($turma)) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'icone' => 'warning');
        } else {
            if ($id == "") {
                    $data = $this->model->insertarEstudante($codigo, $dni, $nome, $turma, $endereco, $telefone);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Estudante cadastrado com sucesso!', 'icone' => 'success');
                    } else if ($data == "existe") {
                        $msg = array('msg' => 'Este estudante já existe!', 'icone' => 'warning');
                    } else {
                        $msg = array('msg' => 'Erro ao cadastrar o estudante!', 'icone' => 'error');
                    }
            } else {
                $data = $this->model->atualizarEstudante($codigo, $dni, $nome, $turma, $endereco, $telefone, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Estudante alterado com sucesso!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar o estudante!', 'icone' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editEstudante($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoEstudante(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Estudante dado baixa com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao dar baixa no estudante!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoEstudante(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Estudante reingressado com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao reingressar estudante!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarEstudante()
    {
        if (isset($_GET['est'])) {
            $valor = $_GET['est'];
            $data = $this->model->buscarEstudante($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}

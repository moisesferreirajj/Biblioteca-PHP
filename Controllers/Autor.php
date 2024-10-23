<?php
class Autor extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Autor") || $this->model->verificarPermissoes($id_user, "Admin") || $this->model->verificarPermissoes($id_user, "Bibliotecario");
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
        $data = $this->model->getAutor();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['imagem'] = '<img class="img-thumbnail" src="' . base_url . "Assets/img/autor/" . $data[$i]['imagem'] . '" width="80">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $autor = strClean($_POST['autor']);
        $img = $_FILES['imagem'];
        $name = $img['name'];
        $id = strClean($_POST['id']);
        $fecha = date("YmdHis");
        $tmpName = $img['tmp_name'];
        if (empty($autor)) {
            $msg = array('msg' => 'É exigido o nome!', 'icone' => 'warning');
        } else {
            if (!empty($name)) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $formatos_permitidos =  array('png', 'jpeg', 'jpg');
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                if (!in_array($extension, $formatos_permitidos)) {
                    $msg = array('msg' => 'Tipo de arquivo não permitido', 'icone' => 'warning');
                } else {
                    $imgNome = $fecha . ".jpg";
                    $destino = "Assets/img/autor/" . $imgNome;
                }
            } else if (!empty($_POST['foto_atual']) && empty($name)) {
                $imgNome = $_POST['foto_atual'];
            } else {
                $imgNome = "logo.png";
            }
            if ($id == "") {
                $data = $this->model->insertarAutor($autor, $imgNome);
                if ($data == "ok") {
                    $msg = array('msg' => 'Autor registrado', 'icone' => 'success');
                    if (!empty($name)) {
                        move_uploaded_file($tmpName, $destino);
                    }
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Este autor já existe!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao cadastrar!', 'icone' => 'error');
                }
            } else {

                $imgDelete = $this->model->editAutor($id);
                if ($imgDelete['imagem'] != 'logo.png') {
                    if (file_exists("Assets/img/autor/" . $imgDelete['imagem'])) {
                        unlink("Assets/img/autor/" . $imgDelete['imagem']);
                    }
                }
                $data = $this->model->atualizarAutor($autor, $imgNome, $id);
                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpName, $destino);
                    }
                    $msg = array('msg' => 'Autor Alterado com sucesso!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar!', 'icone' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editAutor($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoAutor(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Autor desativado com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao desativar!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoAutor(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Autor reingressado com sucesso!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao reingressar', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarAutor()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarAutor($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}

<?php
class Livros extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Livros") || $this->model->verificarPermissoes($id_user, "Admin") || $this->model->verificarPermissoes($id_user, "Bibliotecario");
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
        $data = $this->model->getLivros();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['foto'] = '<img class="img-thumbnail" src="' . base_url . "Assets/img/livros/" . $data[$i]['imagem'] . '" width="100">';
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Ativo</span>';
                $data[$i]['acciones'] = '<div class="d-flex">
                <button class="btn btn-primary" type="button" onclick="btnEditarLivro(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarLivro(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inativo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarLivro(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $titulo = strClean($_POST['titulo']);
        $autor = strClean($_POST['autor']);
        $editora = strClean($_POST['editora']);
        $genero = strClean($_POST['genero']);
        $quantidade = strClean($_POST['quantidade']);
        $num_pagina = strClean($_POST['num_pagina']);
        $ano_edicao = strClean($_POST['ano_edicao']);
        $descricao = strClean($_POST['descricao']);
        $id = strClean($_POST['id']);
        $img = $_FILES['imagem'];
        $name = $img['name'];
        $fecha = date("YmdHis");
        $tmpName = $img['tmp_name'];
        if (empty($titulo) || empty($autor) || empty($editora) || empty($genero) || empty($quantidade)) {
            $msg = array('msg' => 'Todos os campos são exigidos!', 'icone' => 'warning');
        } else {
            if (!empty($name)) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                $formatos_permitidos =  array('png', 'jpeg', 'jpg');
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                if (!in_array($extension, $formatos_permitidos)) {
                    $msg = array('msg' => 'Tipo de arquivo não permitido!', 'icone' => 'warning');
                } else {
                    $imgNome = $fecha . ".jpg";
                    $destino = "Assets/img/livros/" . $imgNome;
                }
            } else if (!empty($_POST['foto_atual']) && empty($name)) {
                $imgNome = $_POST['foto_atual'];
            } else {
                $imgNome = "logo.png";
            }
            if ($id == "") {
                $data = $this->model->insertarLivros($titulo, $autor, $editora, $genero, $quantidade, $num_pagina, $ano_edicao, $descricao, $imgNome);
                if ($data == "ok") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpName, $destino);
                    }
                    $msg = array('msg' => 'Livro cadastrado com sucesso!', 'icone' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Este livro já existe!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao cadastrar o livro!', 'icone' => 'error');
                }
            } else {
                $imgDelete = $this->model->editLivros($id);
                if ($imgDelete['imagem'] != 'logo.png') {
                    if (file_exists("Assets/img/livros/" . $imgDelete['imagem'])) {
                        unlink("Assets/img/livros/" . $imgDelete['imagem']);
                    }
                }
                $data = $this->model->atualizarLivros($titulo, $autor, $editora, $genero, $quantidade, $num_pagina, $ano_edicao, $descricao, $imgNome, $id);
                if ($data == "modificado") {
                    if (!empty($name)) {
                        move_uploaded_file($tmpName, $destino);
                    }
                    $msg = array('msg' => 'Livro alterado com sucesso!', 'icone' => 'success');
                } else {
                    $msg = array('msg' => 'Erro ao alterar o livro!', 'icone' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editLivros($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoLivros(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Livro dado baixa!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao dar baixa!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoLivros(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Livro reingressado!', 'icone' => 'success');
        } else {
            $msg = array('msg' => 'Erro ao reingressar o livro!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function verificar($id_livro)
    {
        if (is_numeric($id_livro)) {
            $data = $this->model->editLivros($id_livro);
            if (!empty($data)) {
                $msg = array('quantidade' => $data['quantidade'], 'icone' => 'success');
            }
        }else{
            $msg = array('msg' => 'Erro Fatal', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarLivro()
    {
        if (isset($_GET['lb'])) {
            $valor = $_GET['lb'];
            $data = $this->model->buscarLivro($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}

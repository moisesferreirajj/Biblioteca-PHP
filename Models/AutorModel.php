<?php
class AutorModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAutor()
    {
        $sql = "SELECT * FROM autor";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarAutor($autor, $img)
    {
        $verificar = "SELECT * FROM autor WHERE autor = '$autor'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO autor(autor, imagem) VALUES (?, ?)";
            $dados = array($autor, $img);
            $data = $this->save($query, $dados);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function editAutor($id)
    {
        $sql = "SELECT * FROM autor WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarAutor($autor, $img, $id)
    {
        $query = "UPDATE autor SET autor = ?, imagem = ? WHERE id = ?";
        $dados = array($autor, $img ,$id);
        $data = $this->save($query, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoAutor($estado, $id)
    {
        $query = "UPDATE autor SET estado = ? WHERE id = ?";
        $dados = array($estado, $id);
        $data = $this->save($query, $dados);
        return $data;
    }
    public function verificarPermissoes($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permissoes p INNER JOIN detalhe_permissoes d ON p.id = d.id_permissao WHERE d.id_usuario = $id_user AND p.nome = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
    public function buscarAutor($valor)
    {
        $sql = "SELECT id, autor AS text FROM autor WHERE autor LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
}

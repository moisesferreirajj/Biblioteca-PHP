<?php
class GeneroModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getGeneros()
    {
        $sql = "SELECT * FROM genero";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarGenero($genero)
    {
        $verificar = "SELECT * FROM genero WHERE genero = '$genero'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO genero(genero) VALUES (?)";
            $dados = array($genero);
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
    public function editGenero($id)
    {
        $sql = "SELECT * FROM genero WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarGenero($genero, $id)
    {
        $query = "UPDATE genero SET genero = ? WHERE id = ?";
        $dados = array($genero, $id);
        $data = $this->save($query, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoGenero($estado, $id)
    {
        $query = "UPDATE genero SET estado = ? WHERE id = ?";
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
    public function buscarGenero($valor)
    {
        $sql = "SELECT id, genero AS text FROM genero WHERE genero LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
}

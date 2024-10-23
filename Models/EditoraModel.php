<?php
class EditoraModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEditora()
    {
        $sql = "SELECT * FROM editora";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarEditora($editora)
    {
        $verificar = "SELECT * FROM editora WHERE editora = '$editora'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO editora(editora) VALUES (?)";
            $dados = array($editora);
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
    public function editEditora($id)
    {
        $sql = "SELECT * FROM editora WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarEditora($editora, $id)
    {
        $query = "UPDATE editora SET editora = ? WHERE id = ?";
        $dados = array($editora, $id);
        $data = $this->save($query, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoEditora($estado, $id)
    {
        $query = "UPDATE editora SET estado = ? WHERE id = ?";
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
    public function buscarEditora($valor)
    {
        $sql = "SELECT id, editora AS text FROM editora WHERE editora LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
}

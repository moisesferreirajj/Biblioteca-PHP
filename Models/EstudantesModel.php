<?php
class EstudantesModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
	
    public function getEstudantes()
    {
        $sql = "SELECT * FROM estudante";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarEstudante($codigo, $dni, $nome, $turma, $endereco, $telefone)
    {
        $verificar = "SELECT * FROM estudante WHERE codigo = '$codigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO estudante(codigo,dni,nome,turma,endereco,telefone) VALUES (?,?,?,?,?,?)";
            $dados = array($codigo, $dni, $nome, $turma, $endereco, $telefone);
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
	
    public function deleteEstudante($id) {
        $query = "DELETE FROM estudante WHERE id = ?";
        $data = $this->delete($query, [$id]); // Utiliza o método delete herdado da classe Query
        return $data;
    }

    public function editEstudante($id)
    {
        $sql = "SELECT * FROM estudante WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarEstudante($codigo, $dni, $nome, $turma, $endereco, $telefone, $id)
    {
        $query = "UPDATE estudante SET codigo = ?, dni = ?, nome = ?, turma = ?, endereco = ?, telefone = ?  WHERE id = ?";
        $dados = array($codigo, $dni, $nome, $turma, $endereco, $telefone, $id);
        $data = $this->save($query, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoEstudante($estado, $id)
    {
        $query = "UPDATE estudante SET estado = ? WHERE id = ?";
        $dados = array($estado, $id);
        $data = $this->save($query, $dados);
        return $data;
    }
    public function buscarEstudante($valor)
    {
        $sql = "SELECT id, codigo, nome AS text FROM estudante WHERE codigo LIKE '%" . $valor . "%' AND estado = 1 OR nome LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
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
}

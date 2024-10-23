<?php
class UsuariosModel extends Query{
    private $usuario, $nome, $chave, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($usuario, $chave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND chave = '$chave' AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario($usuario, $nome, $chave)
    {
        $this->usuario = $usuario;
        $this->nome = $nome;
        $this->chave = $chave;
        $vericar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($vericar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO usuarios(usuario, nome, chave) VALUES (?,?,?)";
            $dados = array($this->usuario, $this->nome, $this->chave);
            $data = $this->save($sql, $dados);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }
    public function modificarUsuario($usuario, $nome, $id)
    {
        $this->usuario = $usuario;
        $this->nome = $nome;
        $this->id = $id;
        $sql = "UPDATE usuarios SET usuario = ?, nome = ? WHERE id = ?";
        $dados = array($this->usuario, $this->nome, $this->id);
        $data = $this->save($sql, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionUser($estado, $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $dados = array($this->estado, $this->id);
        $data = $this->save($sql, $dados);
        return $data;
    }
    public function getPermissoes()
    {
        $sql = "SELECT * FROM permissoes";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallePermissoes($id)
    {
        $sql = "SELECT * FROM detalhe_permissoes WHERE id_usuario = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function deletePermissoes($id)
    {
        $sql = "DELETE FROM detalhe_permissoes WHERE id_usuario = ?";
        $dados = array($id);
        $data = $this->save($sql, $dados);
        return $data;
    }
    public function atualizarPermissoes($usuario, $permiso)
    {
        $sql = "INSERT INTO detalhe_permissoes(id_usuario, id_permissao) VALUES (?,?)";
            $dados = array($usuario, $permiso);
            $data = $this->save($sql, $dados);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        return $res;
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
    public function atualizarPass($chave, $id)
    {
        $sql = "UPDATE usuarios SET chave = ? WHERE id = ?";
        $dados = array($chave, $id);
        $data = $this->save($sql, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
}
?>
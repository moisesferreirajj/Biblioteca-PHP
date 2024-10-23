<?php
class ConfiguracaoModel extends Query{
    protected $id, $nome, $telefone, $endereco, $email, $img;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracao()
    {
        $sql = "SELECT * FROM configuracao";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarConfig($nome, $telefone, $endereco, $email, $img, $id)
    {
        $this->telefone =$telefone;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->email = $email;
        $this->img = $img;
        $this->id = $id;
        $sql = "UPDATE configuracao SET nome = ?, telefone = ?, endereco = ?, email = ?, foto = ? WHERE id = ?";
        $dados = array($this->nome, $this->telefone, $this->endereco, $this->email, $this->img, $this->id);
        $data = $this->save($sql, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function selectDados($nome)
    {
        $sql = "SELECT COUNT(*) AS total FROM $nome WHERE estado = 1";
        $res = $this->select($sql);
        return $res;
    }
    public function getRelatorios()
    {
        $sql = "SELECT titulo, quantidade FROM livro WHERE estado = 1";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getVerificarEmprestimo($date)
    {
        $sql = "SELECT p.id, p.id_estudante, DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') AS data_emprestimo, p.quantidade,p.estado, e.id, e.nome, l.id, l.titulo FROM emprestimo p INNER JOIN estudante e ON p.id_estudante = e.id INNER JOIN livro l ON p.id_livro = l.id WHERE p.fecha_devolucao < '$date' AND p.estado = 1";
        $res = $this->selectAll($sql);
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
}

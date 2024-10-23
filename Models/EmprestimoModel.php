<?php
class emprestimoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getemprestimo()
    {
        $sql = "SELECT e.id, e.nome, l.id, l.titulo, p.id, p.id_estudante, p.id_livro, DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') AS data_emprestimo, DATE_FORMAT(p.fecha_devolucao,'%d/%m/%Y') AS data_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertaremprestimo($estudante,$livro, $quantidade, string $fecha_emprestimo, string $fecha_devolucao, string $observacao)
    {
        $verificar = "SELECT * FROM emprestimo WHERE id_livro = '$livro' AND id_estudante = $estudante AND estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO emprestimo(id_estudante, id_livro, fecha_emprestimo, fecha_devolucao, quantidade, observacao) VALUES (?,?,?,?,?,?)";
            $dados = array($estudante, $livro, $fecha_emprestimo, $fecha_devolucao, $quantidade, $observacao);
            $data = $this->insert($query, $dados);
            if ($data > 0) {
                $lib = "SELECT * FROM livro WHERE id = $livro";
                $reslivro = $this->select($lib);
                $total = $reslivro['quantidade'] - $quantidade;
                $livroUpdate = "UPDATE livro SET quantidade = ? WHERE id = ?";
                $dadoslivro = array($total, $livro);
                $this->save($livroUpdate, $dadoslivro);
                $res = $data;
            } else {
                $res = 0;
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function atualizaremprestimo($estado, $id)
    {
        $sql = "UPDATE emprestimo SET estado = ? WHERE id = ?";
        $dados = array($estado, $id);
        $data = $this->save($sql, $dados);
        if ($data == 1) {
            $lib = "SELECT * FROM emprestimo WHERE id = $id";
            $reslivro = $this->select($lib);
            $id_livro = $reslivro['id_livro'];
            $lib = "SELECT * FROM livro WHERE id = $id_livro";
            $residlivro = $this->select($lib);
            $total = $residlivro['quantidade'] + $reslivro['quantidade'];
            $livroUpdate = "UPDATE livro SET quantidade = ? WHERE id = ?";
            $dadoslivro = array($total, $id_livro);
            $this->save($livroUpdate, $dadoslivro);
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function selectDados()
    {
        $sql = "SELECT * FROM configuracao";
        $res = $this->select($sql);
        return $res;
    }
    public function getCantlivro($livro)
    {
        $sql = "SELECT * FROM livro WHERE id = $livro";
        $res = $this->select($sql);
        return $res;
    }
    public function selectemprestimoDebe()
    {
        $sql = "SELECT e.id, e.nome, l.id, l.titulo, p.id, p.id_estudante, p.id_livro, DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') as data_emprestimo, DATE_FORMAT(p.fecha_devolucao,'%d/%m/%Y') AS data_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id AND p.estado = 1 ORDER BY e.nome ASC";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function verificarPermissoes($id_user, $permissao)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permissoes p INNER JOIN detalhe_permissoes d ON p.id = d.id_permissao WHERE d.id_usuario = $id_user AND p.nome = '$permissao'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
    public function getemprestimolivro($id_emprestimo)
    {
        $sql = "SELECT e.id, e.codigo, e.nome, e.turma, l.id, l.titulo, p.id, p.id_estudante, p.id_livro,  DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') as data_emprestimo, p.fecha_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id AND p.id = $id_emprestimo";
        $res = $this->select($sql);
        return $res;
    }
}

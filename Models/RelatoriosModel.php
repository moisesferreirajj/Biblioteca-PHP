<?php
class EmprestimoModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEmprestimo()
    {
        $sql = "SELECT e.id, e.nome, l.id, l.titulo, p.id, p.id_estudante, p.id_livro, DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') AS data_emprestimo, DATE_FORMAT(p.fecha_devolucao,'%d/%m/%Y') AS data_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarEmprestimo($estudante,$livro, $quantidade, string $fecha_emprestimo, string $fecha_devolucao, string $observacao)
    {
        $verificar = "SELECT * FROM emprestimo WHERE id_livro = '$livro' AND id_estudante = $estudante AND estado = 1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO emprestimo(id_estudante, id_livro, fecha_emprestimo, fecha_devolucao, quantidade, observacao) VALUES (?,?,?,?,?,?)";
            $dados = array($estudante, $livro, $fecha_emprestimo, $fecha_devolucao, $quantidade, $observacao);
            $data = $this->insert($query, $dados);
            if ($data > 0) {
                $lib = "SELECT * FROM livro WHERE id = $livro";
                $resLivro = $this->select($lib);
                $total = $resLivro['quantidade'] - $quantidade;
                $livroUpdate = "UPDATE livro SET quantidade = ? WHERE id = ?";
                $dadosLivro = array($total, $livro);
                $this->save($livroUpdate, $dadosLivro);
                $res = $data;
            } else {
                $res = 0;
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function atualizarEmprestimo($estado, $id)
    {
        $sql = "UPDATE emprestimo SET estado = ? WHERE id = ?";
        $dados = array($estado, $id);
        $data = $this->save($sql, $dados);
        if ($data == 1) {
            $lib = "SELECT * FROM emprestimo WHERE id = $id";
            $resLivro = $this->select($lib);
            $id_livro = $resLivro['id_livro'];
            $lib = "SELECT * FROM livro WHERE id = $id_livro";
            $residLivro = $this->select($lib);
            $total = $residLivro['quantidade'] + $resLivro['quantidade'];
            $livroUpdate = "UPDATE livro SET quantidade = ? WHERE id = ?";
            $dadosLivro = array($total, $id_livro);
            $this->save($livroUpdate, $dadosLivro);
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
    public function getCantLivro($livro)
    {
        $sql = "SELECT * FROM livro WHERE id = $livro";
        $res = $this->select($sql);
        return $res;
    }
    public function selectEmprestimoDebe()
    {
        $sql = "SELECT e.id, e.nome, l.id, l.titulo, p.id, p.id_estudante, p.id_livro, DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') as data_emprestimo, DATE_FORMAT(p.fecha_devolucao,'%d/%m/%Y') AS data_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id AND p.estado = 1 ORDER BY e.nome ASC";
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
    public function getEmprestimoLivro($id_emprestimo)
    {
        $sql = "SELECT e.id, e.codigo, e.nome, e.turma, l.id, l.titulo, p.id, p.id_estudante, p.id_livro,  DATE_FORMAT(p.fecha_emprestimo,'%d/%m/%Y') as data_emprestimo, p.fecha_devolucao, p.quantidade, p.observacao, p.estado FROM estudante e INNER JOIN livro l INNER JOIN emprestimo p ON p.id_estudante = e.id WHERE p.id_livro = l.id AND p.id = $id_emprestimo";
        $res = $this->select($sql);
        return $res;
    }
}

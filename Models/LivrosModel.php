<?php
class LivrosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getLivros()
    {
        $sql = "SELECT l.*, m.genero, a.autor, e.editora FROM livro l INNER JOIN genero m ON l.id_genero = m.id INNER JOIN autor a ON l.id_autor = a.id INNER JOIN editora e ON l.id_editora = e.id";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarLivros($titulo,$id_autor,$id_editora,$id_genero,$quantidade,$num_pagina,$ano_edicao,$descricao,$imgNome)
    {
        $verificar = "SELECT * FROM livro WHERE titulo = '$titulo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO livro(titulo, id_autor, id_editora, id_genero, quantidade, num_pagina, ano_edicao, descricao, imagem) VALUES (?,?,?,?,?,?,?,?,?)";
            $dados = array($titulo, $id_autor, $id_editora, $id_genero, $quantidade, $num_pagina, $ano_edicao, $descricao, $imgNome);
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
    public function editLivros($id)
    {
        $sql = "SELECT * FROM livro WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function atualizarLivros($titulo, $id_autor, $id_editora, $id_genero, $quantidade, $num_pagina, $ano_edicao, $descricao, $imgNome, $id)
    {
        $query = "UPDATE livro SET titulo = ?, id_autor=?, id_editora=?, id_genero=?, quantidade=?, num_pagina=?, ano_edicao=?, descricao=?, imagem=? WHERE id = ?";
        $dados = array($titulo, $id_autor, $id_editora, $id_genero, $quantidade, $num_pagina, $ano_edicao, $descricao, $imgNome, $id);
        $data = $this->save($query, $dados);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoLivros($estado, $id)
    {
        $query = "UPDATE livro SET estado = ? WHERE id = ?";
        $dados = array($estado, $id);
        $data = $this->save($query, $dados);
        return $data;
    }
    public function buscarLivro($valor)
    {
        $sql = "SELECT id, titulo AS text FROM livro WHERE titulo LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
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

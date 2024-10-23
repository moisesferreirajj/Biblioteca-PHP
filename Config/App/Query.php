<?php
class Query extends Conexion {
    private $pdo, $con, $sql, $dados;

    public function __construct() {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }

    public function select(string $sql) {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function selectAll(string $sql) {
        $this->sql = $sql;
        $resul = $this->con->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function save(string $sql, array $dados) {
        $this->sql = $sql;
        $this->dados = $dados;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->dados);
        if ($data) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function insert(string $sql, array $dados) {
        $this->sql = $sql;
        $this->dados = $dados;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->dados);
        if ($data) {
            $res = $this->con->lastInsertId();
        } else {
            $res = 0;
        }
        return $res;
    }

    public function delete(string $sql, array $dados) {
        $this->sql = $sql;
        $this->dados = $dados;
        $delete = $this->con->prepare($this->sql);
        $data = $delete->execute($this->dados);
        if ($data) {
            $res = $delete->rowCount(); // Retorna o número de linhas afetadas
        } else {
            $res = 0;
        }
        return $res;
    }
}
?>

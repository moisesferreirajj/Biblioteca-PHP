<?php
class Configuracao extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
    }
    public function index()
    {
		$id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Configuracao") || $this->model->verificarPermissoes($id_user, "Admin");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permissoes");
            exit;
        }
        $data = $this->model->selectConfiguracao();
        $this->views->getView($this, "index", $data);
    }
    public function atualizar()
    {
		$id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermissoes($id_user, "Configuracao");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permissoes");
            exit;
        }
        $id = strClean($_POST['id']);
        $nome = strClean($_POST['nome']);
        $telefone = strClean($_POST['telefone']);
        $endereco = strClean($_POST['endereco']);
        $email = strClean($_POST['email']);
        $img = $_FILES['imagem'];
        $tmpName = $img['tmp_name'];
        if (empty($id) || empty($nome) || empty($telefone) || empty($endereco) || empty($email)) {
            $msg = array('msg' => 'Todos os campos são obrigatórios!', 'icone' => 'warning');
        } else {
            $name = "logo.png";
            $destino = 'Assets/img/logo.png';
            $data = $this->model->atualizarConfig($nome, $telefone, $endereco, $email, $name, $id);
            if ($data == "modificado") {
                $msg = array('msg' => 'Dados da empresa modificados com sucesso!', 'icone' => 'success');
                if (!empty($img['name'])) {
                    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
                    $formatos_permitidos =  array('png', 'jpeg', 'jpg');
                    $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, $formatos_permitidos)) {
                        $msg = array('msg' => 'Archivo no permitido', 'icone' => 'warning');
                    }else{
                        move_uploaded_file($tmpName, $destino);
                    }
                }
            }
        }
        
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function admin()
    {
        $data['livros'] = $this->model->selectDados('livro');
        $data['generos'] = $this->model->selectDados('genero');
        $data['estudantes'] = $this->model->selectDados('estudante');
        $data['autor'] = $this->model->selectDados('autor');
        $data['editora'] = $this->model->selectDados('editora');
        $data['emprestimo'] = $this->model->selectDados('emprestimo');
        $data['usuarios'] = $this->model->selectDados('usuarios');
        $this->views->getView($this, "home", $data);
    }
    public function grafico()
    {
        $data = $this->model->getRelatorios();
        echo json_encode($data);
        die();
    }
    public function error()
    {
        $this->views->getView($this, "error");
    }
    public function vazio()
    {
        $this->views->getView($this, "vazio");
    }
    public function verificar()
    {
        $date = date('Y-m-d');
        $data = $this->model->getVerificarEmprestimo($date);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function livros()
    {
        $dados = $this->model->selectConfiguracao();
        $date = date('Y-m-d');
        $emprestimo = $this->model->getVerificarEmprestimo($date);
        if (empty($emprestimo)) {
            header('Location: ' . base_url . 'Configuracao/vazio');
        }
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Empréstimos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, utf8_decode($dados['nome']), 0, 1, 'C');

        //$pdf->Image(base_url . "Assets/img/logo.png", 180, 10, 30, 30, 'PNG');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Telefone: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, $dados['telefone'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode("Endereço: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($dados['endereco']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, "E-mail: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 5, utf8_decode($dados['email']), 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, utf8_decode ("Detalhes do empréstimo"), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('Estudantes'), 1, 0, 'L');
        $pdf->Cell(87, 5, 'Livros', 1, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode ('Dt empréstimo'), 1, 0, 'L');
        $pdf->Cell(15, 5, 'Quant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($emprestimo as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(50, 5, $row['nome'], 1, 0, 'L');
            $pdf->Cell(87, 5, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(30, 5, $row['fecha_emprestimo'], 1, 0, 'L');
            $pdf->Cell(15, 5, $row['quantidade'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("emprestimo.pdf", "I");
    }
}

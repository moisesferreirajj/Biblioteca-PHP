<?php
class Emprestimo extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['ativo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
       $perm = $this->model->verificarPermissoes($id_user, "Emprestimo") || $this->model->verificarPermissoes($id_user, "Admin")  || $this->model->verificarPermissoes($id_user, "Bibliotecario");
	   if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permissoes");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getEmprestimo();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-secondary">Emprestado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEntregar(' . $data[$i]['id'] . ');"><i class="fa fa-hourglass-start"></i></button>
                <a class="btn btn-danger" target="_blank" href="'.base_url.'Emprestimo/ticked/'. $data[$i]['id'].'"><i class="fa fa-file-pdf-o"></i></a>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-primary">Devolvido</span>';
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" target="_blank" href="'.base_url.'Emprestimo/ticked/'. $data[$i]['id'].'"><i class="fa fa-file-pdf-o"></i></a>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $livro = strClean($_POST['livro']);
        $estudante = strClean($_POST['estudante']);
        $quantidade = strClean($_POST['quantidade']);
        $fecha_emprestimo = strClean($_POST['fecha_emprestimo']);
        $fecha_devolucao = strClean($_POST['fecha_devolucao']);
        $observacao = strClean($_POST['observacao']);
        if (empty($livro) || empty($estudante) || empty($quantidade) || empty($fecha_emprestimo) || empty($fecha_devolucao)) {
            $msg = array('msg' => 'Todos os campos são obrigatórios!', 'icone' => 'warning');
        } else {
            $verificar_cant = $this->model->getCantLivro($livro);
            if ($verificar_cant['quantidade'] >= $quantidade) {
                $data = $this->model->insertarEmprestimo($estudante,$livro, $quantidade, $fecha_emprestimo, $fecha_devolucao, $observacao);
                if ($data > 0) {
                    $msg = array('msg' => 'Livro emprestado!', 'icone' => 'success', 'id' => $data);
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Este livro está emprestado!', 'icone' => 'warning');
                } else {
                    $msg = array('msg' => 'Erro ao emprestar o livro!', 'icone' => 'error');
                }
            }else{
                $msg = array('msg' => 'Estoque não disponível!', 'icone' => 'warning');
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function entregar($id)
    {
        $dados = $this->model->atualizarEmprestimo(0, $id);
        if ($dados == "ok") {
            $msg = array('msg' => 'Livro recebido!', 'icone' => 'success');
        }else{
            $msg = array('msg' => 'Erro ao receber o livro!', 'icone' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

    }
    public function pdf()
    {
        $dados = $this->model->selectDados();
        $emprestimo = $this->model->selectEmprestimoDebe();
        if (empty($emprestimo)) {
            header('Location: ' . base_url . 'Configuracao/vazio');
        }
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Emprestimos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, utf8_decode($dados['nome']), 0, 1, 'C');

        //$pdf->Image(base_url. "Assets/img/logo.png", 180, 10, 30, 30, 'PNG');
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
        $pdf->Cell(196, 5, utf8_decode("Detalhes do empréstimo"), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, utf8_decode('N°'), 1, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode('Estudantes'), 1, 0, 'L');
        $pdf->Cell(87, 5, 'Livros', 1, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode('Dt empréstimo'), 1, 0, 'L');
        $pdf->Cell(15, 5, 'Quant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($emprestimo as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(50, 5, utf8_decode($row['nome']), 1, 0, 'L');
            $pdf->Cell(87, 5, utf8_decode($row['titulo']), 1, 0, 'L');
            $pdf->Cell(30, 5, $row['data_emprestimo'], 1, 0, 'L');
            $pdf->Cell(15, 5, $row['quantidade'], 1, 1, 'L');
            $contador++;
        }
        $pdf->Output("emprestimo.pdf", "I");
    }
    public function ticked($id_emprestimo)
    {
        $dados = $this->model->selectDados();
        $emprestimo = $this->model->getEmprestimoLivro($id_emprestimo);
        if (empty($emprestimo)) {
            header('Location: '.base_url. 'Configuracao/vazio');
        }
        require_once 'Libraries/pdf/fpdf.php';
        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Emprestimos");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(65, 5, utf8_decode($dados['nome']), 0, 1, 'C');

        //$pdf->Image(base_url . "Assets/img/logo.png", 55, 15, 20, 20, 'PNG');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, utf8_decode("Telefone: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, $dados['telefone'], 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, utf8_decode("Endereço: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, utf8_decode($dados['endereco']), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 5, "E-mail: ", 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 5, utf8_decode($dados['email']), 0, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(72, 5, utf8_decode ("Detalhes do empréstimo"), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(60, 5, 'Livros', 1, 0, 'L');
        $pdf->Cell(12, 5, 'Quant.', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(60, 5, utf8_decode($emprestimo['titulo']), 1, 0, 'L');
        $pdf->Cell(12, 5, $emprestimo['quantidade'], 1, 1, 'L');
        $pdf->Ln();
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(72, 5, utf8_decode("Estudantes"), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35, 5, 'Nome:', 1, 0, 'L');
        $pdf->Cell(37, 5, 'Turma:', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(35, 5, utf8_decode($emprestimo['nome']), 1, 0, 'L');
        $pdf->Cell(37, 5, $emprestimo['turma'], 1, 1, 'L');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(72, 5, utf8_decode('Data do empréstimo'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(72, 5, $emprestimo['data_emprestimo'], 0, 1, 'C');
        $pdf->Output("emprestimo.pdf", "I");
    }
    
}

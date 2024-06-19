<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assistencia_tecnica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

require_once('tcpdf/tcpdf.php');

$id = $_GET['id'];
$sql = "SELECT * FROM ordens_servico WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$html = '<h1>Ordem de Serviço</h1>';
$html .= '<p>Nome Cliente: ' . $row['nome_cliente'] . '</p>';
$html .= '<p>Telefone Cliente: ' . $row['telefone_cliente'] . '</p>';
$html .= '<p>Endereço Cliente: ' . $row['endereco_cliente'] . '</p>';
$html .= '<p>CPF Cliente: ' . $row['cpf_cliente'] . '</p>';
$html .= '<p>Marca: ' . $row['marca'] . '</p>';
$html .= '<p>Modelo: ' . $row['modelo'] . '</p>';
$html .= '<p>Relato do Cliente: ' . $row['relato_cliente'] . '</p>';
$html .= '<p>Primeira Análise Técnica: ' . $row['primeira_analise_tecnica'] . '</p>';
$html .= '<p>Serviço e Valores: ' . $row['servico_e_valores'] . '</p>';
$html .= '<p>Total Pago: ' . $row['total_pago'] . '</p>';
$html .= '<p>Total a Pagar: ' . $row['total_a_pagar'] . '</p>';
$html .= '<p>Status: ' . $row['status'] . '</p>';
$html .= '<p>Data: ' . $row['data'] . '</p>';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('ordem_servico_' . $id . '.pdf', 'I');

$stmt->close();
$conn->close();
?>

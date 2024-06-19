
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

// Função para cadastrar ordem de serviço
function cadastrar_ordem_servico($nome_cliente, $telefone_cliente, $endereco_cliente, $cpf_cliente, $marca, $modelo, $relato_cliente, $primeira_analise_tecnica, $servico_e_valores, $total_pago, $total_a_pagar) {
  $sql = "INSERT INTO ordens_servico (nome_cliente, telefone_cliente, endereco_cliente, cpf_cliente, marca, modelo, relato_cliente, primeira_analise_tecnica, servico_e_valores, total_pago, total_a_pagar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssssss", $nome_cliente, $telefone_cliente, $endereco_cliente, $cpf_cliente, $marca, $modelo, $relato_cliente, $primeira_analise_tecnica, $servico_e_valores, $total_pago, $total_a_pagar);
  $stmt->execute();
  $id = $stmt->insert_id;
  gerar_pdf($id);
  return $id;
}

// Função para consultar ordens de serviço
function consultar_ordens_servico() {
  $sql = "SELECT * FROM ordens_servico";
  $result = $conn->query($sql);
  $ordens_servico = array();
  while ($row = $result->fetch_assoc()) {
    $ordens_servico[] = $row;
  }
  return $ordens_servico;
}

// Função para gerar PDF
function gerar_pdf($id) {
  require_once('tcpdf/tcpdf.php');
  $pdf = new TCPDF();
  $pdf->AddPage();
  $pdf->SetFont('helvetica', '', 12);
  $sql = "SELECT * FROM ordens_servico WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $pdf->Cell(0, 10, 'Ordem de Serviço', 0, 1, 'C');
  $pdf->Cell(0, 10, 'Nome Cliente: ' . $row['nome_cliente'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Telefone Cliente: ' . $row['telefone_cliente'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Endereço Cliente: ' . $row['endereco_cliente'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'CPF Cliente: ' . $row['cpf_cliente'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Marca: ' . $row['marca'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Modelo: ' . $row['modelo'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Relato do Cliente: ' . $row['relato_cliente'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Primeira Análise Técnica: ' . $row['primeira_analise_tecnica'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Serviço e Valores: ' . $row['servico_e_valores'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Total Pago: ' . $row['total_pago'], 0, 1, 'L');
  $pdf->Cell(0, 10, 'Total a Pagar: ' . $row['total_a_pagar'], 0, 1, 'L');
  $pdf->Output('ordem_servico_' . $id . '.pdf', 'D');
}

// Função para consultar ordem de serviço por ID
function consultar_ordem_servico_por_id($id) {
    $sql = "SELECT * FROM ordens_servico WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row;
  }
  
  // Função para atualizar ordem de serviço
  function atualizar_ordem_servico($id, $nome_cliente, $telefone_cliente, $endereco_cliente, $cpf_cliente, $marca, $modelo, $relato_cliente, $primeira_analise_tecnica, $servico_e_valores, $total_pago, $total_a_pagar) {
    $sql = "UPDATE ordens_servico SET nome_cliente = ?, telefone_cliente = ?, endereco_cliente = ?, cpf_cliente = ?, marca = ?, modelo = ?, relato_cliente = ?, primeira_analise_tecnica = ?, servico_e_valores = ?, total_pago = ?, total_a_pagar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssi", $nome_cliente, $telefone_cliente, $endereco_cliente, $cpf_cliente, $marca, $modelo, $relato_cliente, $primeira_analise_tecnica, $servico_e_valores, $total_pago, $total_a_pagar, $id);
    $stmt->execute();
  }
  
  // Função para deletar ordem de serviço
  function deletar_ordem_servico($id) {
    $sql = "DELETE FROM ordens_servico WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
  }
  
  // Fechar conexão com o banco de dados
  $conn->close();
  ?>
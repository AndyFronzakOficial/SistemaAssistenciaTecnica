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

// Receber dados da venda
$items = $_POST['items'];
$totalAmount = $_POST['totalAmount'];
$paidAmount = $_POST['paidAmount'];
$changeAmount = $_POST['changeAmount'];
$date = date('Y-m-d');

// Inserir dados da venda no banco de dados
$sql = "INSERT INTO vendas (data_venda, produto, valor_produto) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

foreach ($items as $item) {
    $stmt->bind_param("sss", $date, $item['name'], $item['price']);
    $stmt->execute();
}

// Fechar conexão com o banco de dados
$stmt->close();
$conn->close();

echo "Venda registrada com sucesso!";
?>

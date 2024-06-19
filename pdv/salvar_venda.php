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

// Receber dados da venda do PDV
$items = $_POST['items']; // Array com os itens da venda
$totalAmount = $_POST['totalAmount']; // Valor total da venda
$paidAmount = $_POST['paidAmount']; // Valor pago pelo cliente
$changeAmount = $_POST['changeAmount']; // Troco

// Salvar a venda no banco de dados
$sql = "INSERT INTO vendas (items, totalAmount, paidAmount, changeAmount, saleDate) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdd", $items, $totalAmount, $paidAmount, $changeAmount);

if ($stmt->execute()) {
    echo "Venda registrada com sucesso!";
} else {
    echo "Erro ao registrar a venda: " . $conn->error;
}

// Fechar conexão com o banco de dados
$conn->close();
?>

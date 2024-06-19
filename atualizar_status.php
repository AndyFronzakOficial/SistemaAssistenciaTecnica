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

// Receber dados do POST
$id = $_POST['id'];
$status = $_POST['status'];

// Atualizar status no banco de dados
$sql = "UPDATE ordens_servico SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo "Status atualizado com sucesso!";
} else {
    echo "Erro ao atualizar status: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

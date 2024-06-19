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

// Consulta ao banco de dados para buscar os produtos
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $produtos = array();
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    echo json_encode($produtos); // Retorna os dados em formato JSON
} else {
    echo json_encode([]);
}

$conn->close();
?>

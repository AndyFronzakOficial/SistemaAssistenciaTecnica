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

// Consulta ao banco de dados para buscar as ordens de serviço
$sql = "SELECT id, nome_cliente, marca, modelo, data, status FROM ordens_servico";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $ordens_servico = array();
    while ($row = $result->fetch_assoc()) {
        $ordens_servico[] = $row;
    }
    echo json_encode($ordens_servico); // Retorna os dados em formato JSON
} else {
    echo json_encode([]);
}

$conn->close();
?>

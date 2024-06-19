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

// Receber dados do formulário
$codigo = $_POST['codigo'];
$produto = $_POST['produto'];
$categoria = $_POST['categoria'];
$valor_venda = $_POST['valor_venda'];
$valor_compra = $_POST['valor_compra'];

// Inserir produto no banco de dados
$sql = "INSERT INTO produtos (codigo, produto, categoria, valor_venda, valor_compra) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdd", $codigo, $produto, $categoria, $valor_venda, $valor_compra);

if ($stmt->execute()) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar produto: " . $conn->error;
}



$stmt->close();
$conn->close();

// Espera 5 segundos
sleep(5);

// Redireciona para a página desejada
header("Location: consultar_produtos.php");
exit();
?>

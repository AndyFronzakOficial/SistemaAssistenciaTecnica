<?php
// Verificar se foi enviado o ID do produto a ser removido
if (isset($_GET['id'])) {
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

    // Receber o ID do produto
    $id = $_GET['id'];

    // Consulta SQL para remover o produto
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirecionar de volta para a página de consulta de produtos após a remoção
    header("Location: consultar_produtos.php");
    exit();
} else {
    // Caso não tenha sido enviado o ID, redirecionar para a página de consulta de produtos
    header("Location: consultar_produtos.php");
    exit();
}
?>

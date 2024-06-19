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

// Verificar se foi enviado um termo de pesquisa
if (isset($_POST['search'])) {
    $searchText = $_POST['search'];

    // Consulta ao banco de dados para buscar produtos correspondentes
    $sql = "SELECT * FROM produtos WHERE produto LIKE '%$searchText%'";
    $result = $conn->query($sql);

    // Exibir resultados da pesquisa
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href='#' class='list-group-item list-group-item-action productItem' data-id='" . $row['id'] . "'>" . $row['produto'] . " R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</a>";
        }
    } else {
        echo "<div class='list-group-item'>Nenhum produto encontrado</div>";
    }
}

// Fechar conexão com o banco de dados
$conn->close();
?>

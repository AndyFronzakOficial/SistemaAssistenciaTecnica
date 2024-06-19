<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Produtos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../components/menu2.html'; ?>

    <div class="container my-4">
        <h1>Produtos Cadastrados</h1>
        <div class="input-group mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar produto">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="btnSearch">Pesquisar</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Valor Venda</th>
                    <th>Valor Compra</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                // Aqui vai o código PHP para listar os produtos, conforme mostrado anteriormente
                
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

                // Consulta SQL para listar os produtos
                $sql = "SELECT * FROM produtos";
                $result = $conn->query($sql);

                // Exibir os produtos na tabela
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['codigo'] . "</td>";
                        echo "<td>" . $row['produto'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</td>";
                        echo "<td>R$ " . number_format($row['valor_compra'], 2, ',', '.') . "</td>";
                        echo "<td><a href='remover_produto.php?id=" . $row['id'] . "' class='btn btn-danger'>Remover</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum produto encontrado.</td></tr>";
                }

                // Fechar conexão com o banco de dados
                $conn->close();
                ?>
                
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS e jQuery (para funcionalidade de pesquisa) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Função para realizar a pesquisa ao clicar no botão
        $(document).ready(function(){
            $("#btnSearch").click(function(){
                var searchText = $("#searchInput").val().toLowerCase();
                $("#tableBody tr").filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
                });
            });
        });
    </script>
</body>
</html>

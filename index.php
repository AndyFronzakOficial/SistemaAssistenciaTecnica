<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistência Técnica</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <?php include_once('./components/menu.html') ?>

    <div class="container">
        <h1 class="my-4">Cadastro de Ordem de Serviço</h1>
        <form id="ordemForm" action="cadastrar_ordem.php" method="post">
            <div class="form-group">
                <label for="nome_cliente">Nome Cliente</label>
                <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
            </div>
            <div class="form-group">
                <label for="telefone_cliente">Telefone Cliente</label>
                <input type="text" class="form-control" id="telefone_cliente" name="telefone_cliente" required>
            </div>
            <div class="form-group">
                <label for="endereco_cliente">Endereço Cliente</label>
                <input type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" required>
            </div>
            <div class="form-group">
                <label for="cpf_cliente">CPF Cliente</label>
                <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" required>
            </div>
            <div class="form-group">
                <label for="relato_cliente">Relato do Cliente</label>
                <textarea class="form-control" id="relato_cliente" name="relato_cliente" required></textarea>
            </div>
            <div class="form-group">
                <label for="primeira_analise_tecnica">Primeira Análise Técnica</label>
                <textarea class="form-control" id="primeira_analise_tecnica" name="primeira_analise_tecnica" required></textarea>
            </div>
            <div class="form-group">
                <label for="servico_e_valores">Serviço e Valores</label>
                <textarea class="form-control" id="servico_e_valores" name="servico_e_valores" required></textarea>
            </div>
            <div class="form-group">
                <label for="total_pago">Total Pago</label>
                <input type="text" class="form-control" id="total_pago" name="total_pago" required>
            </div>
            <div class="form-group">
                <label for="total_a_pagar">Total a Pagar</label>
                <input type="text" class="form-control" id="total_a_pagar" name="total_a_pagar" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Ordem de Serviço</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

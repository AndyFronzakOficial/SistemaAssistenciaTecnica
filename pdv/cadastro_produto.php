<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include '../components/menu2.html'; ?>

    <div class="container mt-5">
        <h2>Cadastro de Produtos</h2>
        <form action="salvar_produto.php" method="POST">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="produto">Produto</label>
                <input type="text" class="form-control" id="produto" name="produto" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="valor_venda">Valor Venda</label>
                <input type="number" step="0.01" class="form-control" id="valor_venda" name="valor_venda" required>
            </div>
            <div class="form-group">
                <label for="valor_compra">Valor Compra</label>
                <input type="number" step="0.01" class="form-control" id="valor_compra" name="valor_compra" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </form>
    </div>
</body>
</html>

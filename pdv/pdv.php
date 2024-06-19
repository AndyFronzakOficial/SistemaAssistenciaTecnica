<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV - Ponto de Venda</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1>PDV - Ponto de Venda</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h4>Pesquisar Produto</h4>
                <div class="input-group mb-3">
                    <input type="text" id="searchProduct" class="form-control" placeholder="Digite para pesquisar produto">
                    <div class="input-group-append">
                        <button id="btnSearch" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
                <div id="searchResults" class="list-group">
                    <!-- Resultados da pesquisa serão exibidos aqui -->
                </div>
            </div>
            <div class="col-md-6">
                <h4>Itens Selecionados</h4>
                <ul id="selectedItemsList" class="list-group">
                    <!-- Itens selecionados serão listados aqui -->
                </ul>
                <hr>
                <h4>Total da Compra</h4>
                <div id="totalAmount" class="alert alert-primary">R$ 0.00</div>
                <div id="paymentSection">
                    <label for="paidAmount">Valor Pago pelo Cliente:</label>
                    <input type="text" id="paidAmount" class="form-control mb-2" placeholder="Digite o valor pago">
                    <button id="btnCalculateChange" class="btn btn-info mb-2">Calcular Troco</button>
                    <button id="btnFinishSale" class="btn btn-success btn-block">Finalizar Venda</button>
                </div>
                <div id="changeSection">
                    <hr>
                    <h4>Troco</h4>
                    <div id="changeAmount" class="alert alert-success">R$ 0.00</div>
                    <button id="btnNewSale" class="btn btn-info btn-block mt-2">Nova Venda</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            var totalAmount = 0;
            var selectedItems = [];

            $("#btnSearch").click(function(){
                var searchText = $("#searchProduct").val().toLowerCase();
                if (searchText.length > 0) {
                    // Consulta ao banco de dados para buscar produtos correspondentes
                    $.ajax({
                        url: "buscar_produtos.php",
                        type: "POST",
                        data: {search: searchText},
                        success: function(response){
                            $("#searchResults").html(response);
                        }
                    });
                } else {
                    $("#searchResults").empty();
                }
            });

            // Adicionar produto ao selecionar na lista de resultados da pesquisa
            $(document).on("click", ".productItem", function(){
                var productId = $(this).data("id");
                var productName = $(this).text();
                var productPrice = parseFloat(productName.split("R$ ")[1].replace(",", "."));
                totalAmount += productPrice;

                var itemExists = false;
                for (var i = 0; i < selectedItems.length; i++) {
                    if (selectedItems[i].id === productId) {
                        selectedItems[i].quantity++;
                        itemExists = true;
                        break;
                    }
                }

                if (!itemExists) {
                    selectedItems.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    });
                }

                updateSelectedItemsList();
                updateTotalAmount();
            });

            $("#btnCalculateChange").click(function(){
                var paidAmount = parseFloat($("#paidAmount").val().replace(",", "."));
                var changeAmount = paidAmount - totalAmount;

                $("#changeAmount").text("Troco: R$ " + changeAmount.toFixed(2));
                $("#paymentSection").show();
                $("#changeSection").hide();
            });

            $("#btnFinishSale").click(function(){
                var paidAmount = parseFloat($("#paidAmount").val().replace(",", "."));
                var changeAmount = paidAmount - totalAmount;

                $.ajax({
                    url: "salvar_venda.php",
                    type: "POST",
                    data: {
                        items: JSON.stringify(selectedItems),
                        totalAmount: totalAmount,
                        paidAmount: paidAmount,
                        changeAmount: changeAmount
                    },
                    success: function(response){
                        alert(response); // Exibir mensagem de sucesso ou erro
                        $("#paymentSection").hide();
                        $("#changeSection").show();
                        $("#changeAmount").text("Troco: R$ " + changeAmount.toFixed(2));
                    },
                    error: function(xhr, status, error){
                        console.log(xhr.responseText); // Exibir detalhes do erro no console
                    }
                });
            });

            $("#btnNewSale").click(function(){
                totalAmount = 0;
                selectedItems = [];
                updateSelectedItemsList();
                updateTotalAmount();
                $("#paymentSection").show();
                $("#changeSection").hide();
            });

            function updateSelectedItemsList(){
                $("#selectedItemsList").empty();
                selectedItems.forEach(function(item){
                    var itemText = item.quantity + "x " + item.name + " R$" + item.price.toFixed(2);
                    $("#selectedItemsList").append("<li class='list-group-item'>" + itemText + "</li>");
                });
            }

            function updateTotalAmount(){
                $("#totalAmount").text("Total: R$ " + totalAmount.toFixed(2));
            }
        });
    </script>
</body>
</html>

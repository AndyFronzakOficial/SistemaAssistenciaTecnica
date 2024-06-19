<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Ordens de Serviço</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Inclui o menu superior -->
    <?php include './components/menu.html'; ?>

    <div class="container mt-5">
        <h2>Consultar Ordens de Serviço</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Nome Cliente</th>
                    <th>Aparelho</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Consultar</th>
                </tr>
            </thead>
            <tbody id="ordensTableBody"></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para carregar as ordens de serviço via AJAX
            function loadOrdens() {
                $.ajax({
                    url: 'consultar_ordens.php',
                    method: 'GET',
                    success: function(data) {
                        var ordens = JSON.parse(data);
                        var ordensTableBody = $('#ordensTableBody');
                        ordensTableBody.empty();

                        ordens.forEach(function(ordem) {
                            var statusColor = '';
                            switch (ordem.status) {
                                case 'Cancelado':
                                    statusColor = 'text-secondary';
                                    break;
                                case 'Bancada':
                                    statusColor = 'text-warning';
                                    break;
                                case 'Pronto':
                                    statusColor = 'text-success';
                                    break;
                                case 'Sem conserto':
                                    statusColor = 'text-danger';
                                    break;
                            }

                            var row = '<tr>';
                            row += '<td>' + ordem.id + '</td>';
                            row += '<td>' + ordem.nome_cliente + '</td>';
                            row += '<td>' + ordem.marca + ' ' + ordem.modelo + '</td>';
                            row += '<td>' + ordem.data + '</td>';
                            row += '<td>';
                            row += '<select class="form-control status-dropdown ' + statusColor + '" data-id="' + ordem.id + '">';
                            row += '<option value="Cancelado" ' + (ordem.status === 'Cancelado' ? 'selected' : '') + '>Cancelado</option>';
                            row += '<option value="Bancada" ' + (ordem.status === 'Bancada' ? 'selected' : '') + '>Bancada</option>';
                            row += '<option value="Pronto" ' + (ordem.status === 'Pronto' ? 'selected' : '') + '>Pronto</option>';
                            row += '<option value="Sem conserto" ' + (ordem.status === 'Sem conserto' ? 'selected' : '') + '>Sem conserto</option>';
                            row += '</select>';
                            row += '</td>';
                            row += '<td><a href="gerar_pdf.php?id=' + ordem.id + '" class="btn btn-success">Gerar PDF</a></td>';
                            row += '</tr>';

                            ordensTableBody.append(row);
                        });

                        // Adicionar evento de mudança no dropdown de status
                        $('.status-dropdown').change(function() {
                            var id = $(this).data('id');
                            var newStatus = $(this).val();

                            $.ajax({
                                url: 'atualizar_status.php',
                                method: 'POST',
                                data: { id: id, status: newStatus },
                                success: function(response) {
                                    alert('Status atualizado com sucesso!');
                                    // Recarregar ordens para atualizar as cores
                                    loadOrdens();
                                },
                                error: function() {
                                    alert('Erro ao atualizar status.');
                                }
                            });
                        });
                    },
                    error: function() {
                        alert('Erro ao carregar ordens de serviço.');
                    }
                });
            }

            // Chama a função para carregar as ordens de serviço ao carregar a página
            loadOrdens();
        });
    </script>
</body>
</html>

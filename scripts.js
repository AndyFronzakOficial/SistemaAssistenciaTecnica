$(document).ready(function() {
    $('#ordemForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'cadastrar_ordem.php',
            data: $(this).serialize(),
            success: function(response) {
                alert('Ordem de serviço cadastrada com sucesso!');
                window.location.reload();
            },
            error: function() {
                alert('Erro ao cadastrar ordem de serviço.');
            }
        });
    });

    function loadOrdens() {
        $.ajax({
            url: 'consultar_ordens.php',
            method: 'GET',
            success: function(data) {
                let ordens = JSON.parse(data);
                let ordensTableBody = $('#ordensTableBody');
                ordensTableBody.empty();

                ordens.forEach(ordem => {
                    let statusClass = '';
                    switch (ordem.status) {
                        case 'Cancelado':
                            statusClass = 'text-secondary';
                            break;
                        case 'Bancada':
                            statusClass = 'text-warning';
                            break;
                        case 'Pronto':
                            statusClass = 'text-success';
                            break;
                        case 'Sem conserto':
                            statusClass = 'text-danger';
                            break;
                    }

                    ordensTableBody.append(`
                        <tr>
                            <td>${ordem.id}</td>
                            <td>${ordem.nome_cliente}</td>
                            <td>${ordem.marca} ${ordem.modelo}</td>
                            <td>${ordem.data}</td>
                            <td class="${statusClass}">${ordem.status}</td>
                            <td>
                                <a href="gerar_pdf.php?id=${ordem.id}" class="btn btn-primary">Gerar Ordem</a>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function() {
                alert('Erro ao carregar ordens de serviço.');
            }
        });
    }

    loadOrdens();
});

# SistemaAssistenciaTecnica

Este é um sistema de PDV (Ponto de Venda) básico desenvolvido com HTML, CSS, JavaScript, PHP e MySQL. O sistema permite pesquisar, selecionar produtos, calcular o total da compra, calcular o troco e registrar as vendas no banco de dados.

## Funcionalidades

- Pesquisa de produtos
- Seleção de itens para a venda
- Cálculo do total da compra
- Registro do valor pago pelo cliente
- Cálculo do troco
- Registro da venda no banco de dados
- Geração de relatórios de venda

## Tecnologias Utilizadas

- HTML
- CSS
- Bootstrap
- JavaScript
- jQuery
- PHP
- MySQL

## Configuração do Ambiente

1. Clone este repositório em sua máquina local:
   ```sh
   git clone https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica.git
Navegue até o diretório do projeto:

sh
Copiar código
cd seu-repositorio
Importe o banco de dados. Execute o script SQL abaixo no seu servidor MySQL para criar as tabelas necessárias:

sql
Copiar código
CREATE DATABASE assistencia_tecnica;
USE assistencia_tecnica;

CREATE TABLE produtos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  codigo VARCHAR(50),
  nome_produto VARCHAR(255),
  categoria VARCHAR(255),
  valor_venda DECIMAL(10, 2),
  valor_compra DECIMAL(10, 2)
);

CREATE TABLE vendas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  data_venda DATETIME,
  produto_id INT,
  quantidade INT,
  valor_unitario DECIMAL(10, 2),
  valor_total DECIMAL(10, 2),
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
Configure a conexão com o banco de dados no arquivo config.php:

php
Copiar código
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assistencia_tecnica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
Estrutura dos Arquivos
index.html: Página inicial.
pdv.php: Página principal do PDV.
buscar_produtos.php: Script para buscar produtos no banco de dados.
salvar_venda.php: Script para salvar a venda no banco de dados.
config.php: Configuração da conexão com o banco de dados.
Uso
Abra o navegador e acesse http://localhost/seu-repositorio/index.html.
Utilize o campo de pesquisa para buscar produtos.
Adicione produtos à lista de itens selecionados.
Insira o valor pago pelo cliente e clique em "Calcular Troco" para calcular o troco.
Clique em "Finalizar Venda" para registrar a venda no banco de dados.
Contribuição
Sinta-se à vontade para contribuir com este projeto. Você pode abrir issues e pull requests para adicionar novas funcionalidades ou corrigir bugs.

Licença
Este projeto está licenciado sob a MIT License - veja o arquivo LICENSE para mais detalhes.
![Captura de tela_19-6-2024_8247_localhost](https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica/assets/30420866/ad5a8957-f348-41d0-98fa-290fe4c7460b)
![Captura de tela_19-6-2024_8328_localhost](https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica/assets/30420866/2f6045a6-dd29-494e-9b33-58053d22d329)
![Captura de tela_19-6-2024_8355_localhost](https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica/assets/30420866/cea87027-e89c-48ce-b5a6-e88e24a05b84)
![Captura de tela_19-6-2024_8413_localhost](https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica/assets/30420866/e82c08a9-e333-4ba6-8b90-d48937edd8f7)
![Captura de tela_19-6-2024_8443_localhost](https://github.com/AndyFronzakOficial/SistemaAssistenciaTecnica/assets/30420866/38e23d5d-b7cb-4fe3-ac52-729d30e4a0fc)


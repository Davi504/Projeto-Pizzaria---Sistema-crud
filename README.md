# Projeto Pizzaria -- Sistema CRUD

## Descrição
Este projeto é um sistema CRUD para gerenciar os pedidos e o cadastro de produtos de uma pizzaria, desenvolvido utilizando PHP, MySQL, HTML, CSS e Bootstrap. O objetivo é permitir que os administradores da pizzaria façam o gerenciamento completo dos pedidos e do catálogo de pizzas, incluindo criação, visualização, atualização e exclusão de registros.

## Video da aplicação rodando

[Link do video](https://youtu.be/D9-umihUqf8?si=G3LAVGSNNSb8ze38)


### Objetivo
O principal objetivo deste projeto é facilitar o gerenciamento de pedidos e produtos de uma pizzaria através de uma interface web intuitiva, permitindo uma administração eficiente e prática.

### Público-alvo
O projeto é destinado a proprietários e administradores de pizzarias que necessitam de uma solução simples e eficaz para gerenciar seus pedidos e catálogo de produtos.

### Futuras Melhorias
- Adicionar funcionalidades de relatório para análise de vendas.
- Implementar um sistema de notificações para novos pedidos.
- Melhorar a interface de usuário com novas funcionalidades de design.
- Integração com sistemas de pagamento online.

## Processo de Desenvolvimento
O desenvolvimento da aplicação começou com a modelagem de dados para garantir uma estrutura de banco de dados eficiente e escalável. Utilizei PHP para o desenvolvimento do backend, onde implementei todas as operações CRUD (Create, Read, Update, Delete). A interface foi criada com HTML e CSS, e utilizei Bootstrap para garantir a responsividade em diferentes dispositivos.

O foco principal foi garantir uma experiência de usuário intuitiva. Testei a aplicação extensivamente para assegurar que todos os fluxos de pedidos e gerenciamento de produtos fossem funcionais e fáceis de usar. A integração do banco de dados MySQL foi otimizada para rápidas consultas e armazenamento seguro de dados.

## Problemas Encontrados e Soluções

### Desempenho da Consulta ao Banco de Dados
- **Problema**: As consultas aos dados dos pedidos estavam lentas devido ao grande volume de registros.
- **Solução**: Implementei índices nas tabelas principais e usei consultas SQL otimizadas para melhorar o desempenho.

### Responsividade em Dispositivos Móveis
- **Problema**: A interface não estava se adaptando bem em telas menores.
- **Solução**: Ajustei o layout utilizando o grid system do Bootstrap e media queries customizadas para garantir uma boa aparência em todos os dispositivos.

## Tecnologias Usadas
[![My Skills](https://skillicons.dev/icons?i=html,css,bootstrap,php,mysql)](https://skillicons.dev)

## Funcionalidades Principais
1. **Gerenciamento de Pedidos**:
   - Criação, visualização, atualização e exclusão de pedidos de pizzas, incluindo informações sobre tipos de pizzas, quantidade e status do pedido.
2. **Cadastro de Produtos**:
   - Administração do catálogo de pizzas, permitindo adicionar novas pizzas, visualizar detalhes, atualizar preços e descrições, e remover pizzas do menu.
3. **Interface Amigável**:
   - Interface web intuitiva e responsiva, facilitada pelo uso do Bootstrap, para melhorar a experiência do usuário.

## Modelagem de Dados
O projeto inclui um arquivo `ref_pizzaria.mwb` que contém o diagrama do banco de dados, proporcionando uma visão clara da estrutura e das relações entre as tabelas.

O arquivo `comandos.txt` é um arquivo de texto com todos os comandos SQL necessários para criar e popular o banco de dados MySQL utilizado no projeto. Certifique-se de executar esses comandos antes de iniciar o sistema.

## Como Rodar o Projeto na Sua Máquina
1. Clone o repositório:
    ```sh
    git clone https://github.com/Davi504/Projeto-Pizzaria---Sistema-crud.git
    cd Projeto-Pizzaria---Sistema-crud
    ```
2. Instale e Configure o XAMPP:
   - Baixe e instale o XAMPP.
   - Inicie Apache e MySQL no painel de controle do XAMPP.
3. Crie o banco de dados usando o arquivo `comandos.txt`.
4. Configure o projeto:
   - Abra o projeto no Visual Studio Code (ou qualquer editor de sua preferência).
   - Edite o arquivo de configuração do banco de dados (`conn.php ou similar`) com os detalhes do seu banco de dados MySQL.
5. Execute o projeto:
   - Coloque a pasta do projeto na pasta `htdocs` do XAMPP.
   - No navegador, digite `http://localhost` para acessar o projeto.

## Licença
Este projeto está sob a licença GNU. Consulte o arquivo LICENSE para mais detalhes.

- [GNU](https://www.gnu.org/)

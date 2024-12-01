<?php

  // Inicia a sessão para gerenciar dados do usuário durante a navegação
  session_start();

  // Credenciais para conexão com o banco de dados MySQL
  $user = "root"; // Usuário do banco de dados
  $pass = ""; // Senha do banco de dados
  $db = "pizzaria"; // Nome do banco de dados
  $host = "localhost"; // Host do banco de dados

  try {
    // Tenta estabelecer uma conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    // Configura o modo de erro do PDO para lançar exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Desativa a emulação de prepares para usar prepare statements nativos
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  } catch (PDOException $e) {
    // Captura e exibe qualquer erro ocorrido durante a tentativa de conexão
    print "Erro: " . $e->getMessage() . "<br/>";
    // Encerra o script caso haja uma exceção
    die();
  }

?>

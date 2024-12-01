<?php

  // Inclui o arquivo de conexão com o banco de dados
  include_once("conn.php");

  // Obtém o método da requisição HTTP
  $method = $_SERVER["REQUEST_METHOD"];

  // Resgate dos dados e montagem do pedido
  if($method === "GET") {

    // Consulta todas as bordas disponíveis
    $bordasQuery = $conn->query("SELECT * FROM bordas;");
    $bordas = $bordasQuery->fetchAll();

    // Consulta todas as massas disponíveis
    $massasQuery = $conn->query("SELECT * FROM massas;");
    $massas = $massasQuery->fetchAll();

    // Consulta todos os sabores disponíveis
    $saboresQuery = $conn->query("SELECT * FROM sabores;");
    $sabores = $saboresQuery->fetchAll();
  
  // Criação do pedido
  } else if($method === "POST") {

    // Obtém os dados do formulário de pedido
    $data = $_POST;

    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];

    // Validação do número máximo de sabores
    if(count($sabores) > 3) {
      // Define mensagem de alerta se mais de 3 sabores forem selecionados
      $_SESSION["msg"] = "Selecione no máximo 3 sabores!";
      $_SESSION["status"] = "warning";
    } else {
      // Salvando a borda e a massa na tabela de pizzas
      $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");

      // Filtrando inputs
      $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
      $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

      // Executa a query
      $stmt->execute();

      // Resgata o ID da última pizza inserida
      $pizzaId = $conn->lastInsertId();

      // Prepara a query para inserir os sabores da pizza
      $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");

      // Itera pelos sabores e os insere na tabela de pizza_sabor
      foreach($sabores as $sabor) {
        // Filtrando inputs
        $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
        $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);

        // Executa a query
        $stmt->execute();
      }

      // Cria o pedido da pizza com status inicial
      $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)");

      // Status inicial é 1 (em produção)
      $statusId = 1;

      // Filtrando inputs
      $stmt->bindParam(":pizza", $pizzaId);
      $stmt->bindParam(":status", $statusId);

      // Executa a query
      $stmt->execute();

      // Exibe mensagem de sucesso
      $_SESSION["msg"] = "Pedido realizado com sucesso";
      $_SESSION["status"] = "success";
    }

    // Retorna para página inicial
    header("Location: ..");

  }

?>

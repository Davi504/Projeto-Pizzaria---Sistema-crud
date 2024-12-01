<?php

  // Inclui o arquivo de conexão com o banco de dados
  include_once("conn.php");

  // Obtém o método da requisição HTTP
  $method = $_SERVER["REQUEST_METHOD"];

  if($method === "GET") {

    // Consulta todos os pedidos
    $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

    // Fetch all pedidos from the database
    $pedidos = $pedidosQuery->fetchAll();

    // Initialize an empty array to hold the pizzas
    $pizzas = [];

    // Montando cada pizza do pedido
    foreach($pedidos as $pedido) {

      // Inicializa o array para a pizza
      $pizza = [];

      // Define o id da pizza
      $pizza["id"] = $pedido["pizza_id"];

      // Resgata as informações da pizza
      $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");

      // Vincula o parâmetro id da pizza
      $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);

      // Executa a query
      $pizzaQuery->execute();

      // Fetch the pizza data
      $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

      // Resgata a borda da pizza
      $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");

      // Vincula o parâmetro id da borda
      $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);

      // Executa a query
      $bordaQuery->execute();

      // Fetch the borda data
      $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);

      // Adiciona o tipo da borda no array da pizza
      $pizza["borda"] = $borda["tipo"];

      // Resgata a massa da pizza
      $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");

      // Vincula o parâmetro id da massa
      $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);

      // Executa a query
      $massaQuery->execute();

      // Fetch the massa data
      $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);

      // Adiciona o tipo da massa no array da pizza
      $pizza["massa"] = $massa["tipo"];

      // Resgata os sabores da pizza
      $saboresQuery = $conn->prepare("SELECT * FROM pizza_sabor WHERE pizza_id = :pizza_id");

      // Vincula o parâmetro id da pizza
      $saboresQuery->bindParam(":pizza_id", $pizza["id"]);

      // Executa a query
      $saboresQuery->execute();

      // Fetch the sabores data
      $sabores = $saboresQuery->fetchAll(PDO::FETCH_ASSOC);

      // Inicializa um array para os nomes dos sabores
      $saboresDaPizza = [];

      // Prepara a query para resgatar o nome dos sabores
      $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id = :sabor_id");

      foreach($sabores as $sabor) {

        // Vincula o parâmetro id do sabor
        $saborQuery->bindParam(":sabor_id", $sabor["sabor_id"]);

        // Executa a query
        $saborQuery->execute();

        // Fetch the sabor data
        $saborPizza = $saborQuery->fetch(PDO::FETCH_ASSOC);

        // Adiciona o nome do sabor no array dos sabores da pizza
        array_push($saboresDaPizza, $saborPizza["nome"]);

      }

      // Adiciona os sabores ao array da pizza
      $pizza["sabores"] = $saboresDaPizza;

      // Adiciona o status do pedido ao array da pizza
      $pizza["status"] = $pedido["status_id"];

      // Adiciona o array da pizza ao array das pizzas
      array_push($pizzas, $pizza);

    }

    // Resgata todos os status possíveis
    $statusQuery = $conn->query("SELECT * FROM status;");

    // Fetch all status from the database
    $status = $statusQuery->fetchAll();

  } else if($method === "POST") {

    // Verifica o tipo de requisição POST
    $type = $_POST["type"];

    // Deletar pedido
    if($type === "delete") {

      // Obtém o id da pizza a ser deletada
      $pizzaId = $_POST["id"];

      // Prepara a query para deletar o pedido
      $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE pizza_id = :pizza_id;");

      // Vincula o parâmetro id da pizza
      $deleteQuery->bindParam(":pizza_id", $pizzaId, PDO::PARAM_INT);

      // Executa a query
      $deleteQuery->execute();

      // Define a mensagem de sucesso
      $_SESSION["msg"] = "Pedido removido com sucesso!";
      $_SESSION["status"] = "success";

    // Atualizar status do pedido
    } else if($type === "update") {

      // Obtém o id da pizza e o novo status
      $pizzaId = $_POST["id"];
      $statusId = $_POST["status"];

      // Prepara a query para atualizar o status do pedido
      $updateQuery = $conn->prepare("UPDATE pedidos SET status_id = :status_id WHERE pizza_id = :pizza_id");

      // Vincula os parâmetros id da pizza e id do status
      $updateQuery->bindParam(":pizza_id", $pizzaId, PDO::PARAM_INT);
      $updateQuery->bindParam(":status_id", $statusId, PDO::PARAM_INT);

      // Executa a query
      $updateQuery->execute();

      // Define a mensagem de sucesso
      $_SESSION["msg"] = "Pedido atualizado com sucesso!";
      $_SESSION["status"] = "success";

    }

    // Redireciona o usuário para a página do dashboard
    header("Location: ../dashboard.php");

  }

?>

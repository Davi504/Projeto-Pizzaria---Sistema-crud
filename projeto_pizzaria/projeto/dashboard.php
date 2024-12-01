<?php
  // Inclui o cabeçalho da página
  include_once("templates/header.php");
  // Inclui o arquivo que processa os pedidos
  include_once("process/orders.php");
?>
  <div id="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Gerenciar pedidos:</h2>
        </div>
        <div class="col-md-12 table-container">
          <table class="table">
            <thead>
              <tr>
                <th scope="col"><span>Pedido</span> #</th>
                <th scope="col">Borda</th>
                <th scope="col">Massa</th>
                <th scope="col">Sabores</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pizzas as $pizza): ?>
                <tr>
                  <!-- Exibe o ID da pizza -->
                  <td><?= $pizza["id"] ?></td>
                  <!-- Exibe a borda da pizza -->
                  <td><?= $pizza["borda"] ?></td>
                  <!-- Exibe a massa da pizza -->
                  <td><?= $pizza["massa"] ?></td>
                  <td>
                    <ul>
                      <!-- Exibe os sabores da pizza -->
                      <?php foreach($pizza["sabores"] as $sabor): ?>
                        <li><?= $sabor ;?></li>
                      <?php endforeach; ?>
                    </ul>
                  </td>
                  <td>
                    <!-- Formulário para atualizar o status do pedido -->
                    <form action="process/orders.php" method="POST" class="form-group update-form">
                      <input type="hidden" name="type" value="update">
                      <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                      <select name="status" class="form-control status-input">
                        <!-- Exibe as opções de status -->
                        <?php foreach($status as $s): ?>
                          <option value="<?= $s["id"] ?>" <?php echo ($s["id"] == $pizza["status"]) ? "selected" : ""; ?> ><?= $s["tipo"] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <button type="submit" class="update-btn">
                        <i class="fas fa-sync-alt"></i>
                      </button>
                    </form>
                  </td>
                  <td>
                    <!-- Formulário para deletar o pedido -->
                    <form action="process/orders.php" method="POST">
                      <input type="hidden" name="type" value="delete">
                      <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                      <button type="submit" class="delete-btn">
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php
  // Inclui o rodapé da página
  include_once("templates/footer.php");
?>

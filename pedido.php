<?php

  // Insere o pedido na tabela pedidos
  $sql_pedido = "INSERT INTO pedidos (email_cliente, total) VALUES (?, ?)";
  $stmt_pedido = $conn->prepare($sql_pedido);
  $stmt_pedido->bind_param("id", $cliente_email, $total_pedido);
  $id_usuario = $_SESSION['email'];
  $total_pedido = calcularTotalPedido($cart);
  $stmt_pedido->execute();

  $id_pedido = $stmt_pedido->insert_id; // Obtém o id_pedido gerado automaticamente

  // Insere os itens do carrinho na tabela itens_pedido
  foreach ($cart as $item) {
      $id_produto = $item['id'];
      $quantidade = 1; // Aqui você pode ajustar a quantidade de acordo com a lógica do seu carrinho
      $preco_unitario = $item['preco'];
      
      $sql_item_pedido = "INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario) VALUES (?, ?, ?, ?)";
      $stmt_item_pedido = $conn->prepare($sql_item_pedido);
      $stmt_item_pedido->bind_param("iiid", $id_pedido, $id_produto, $quantidade, $preco_unitario);
      $stmt_item_pedido->execute();
  }

  // Função para calcular o total do pedido
  function calcularTotalPedido($cart) {
      $total = 0;
      foreach ($cart as $item) {
          $total += $item['preco'];
      }
      return $total;
  }


?>
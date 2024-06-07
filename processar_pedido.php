<?php
session_start();

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'kiwi';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Falha na conexão com o banco de dados " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Faça o login para continuar.']);
    exit();
}

$email = $_SESSION['email'];

$sql = "INSERT INTO pedidos (email_cliente, total) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$total = 0;

foreach ($data as $item) {
    $total += $item['price'] * $item['quantity'];
}

$stmt->bind_param("sd", $email, $total);
$stmt->execute();

$id_pedido = $stmt->insert_id;

foreach ($data as $item) {
    $id_produto = $item['id'];
    $quantidade = $item['quantity']; 
    $preco_unitario = $item['price'];

    $sql = "INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $id_pedido, $id_produto, $quantidade, $preco_unitario);
    $stmt->execute();
}

$conn->close();

echo json_encode(['success' => true, 'message' => 'Pedido finalizado com sucesso.']);

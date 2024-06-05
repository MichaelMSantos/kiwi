<?php
$server = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kiwi";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT id, nome, descricao, valor FROM produtos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Produto não encontrado']);
}

$conn->close();
?>

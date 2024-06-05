<?php

$server = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "kiwi";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $sql_select_image = "SELECT imagem FROM produtos WHERE id = $id";
    $result = $conn->query($sql_select_image);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagem_path = $row['imagem'];
        $sql_delete = "DELETE FROM produtos WHERE id = $id";
        if ($conn->query($sql_delete) === TRUE) {
            if (unlink($imagem_path)) {
                echo json_encode(["message" => "Produto excluído com sucesso"]);
            } else {
                echo json_encode(["message" => "Erro ao excluir a imagem do produto"]);
            }
        } else {
            echo json_encode(["message" => "Erro ao excluir o produto: " . $conn->error]);
        }
    } else {
        echo json_encode(["message" => "Produto não encontrado"]);
    }
} else {
    echo json_encode(["message" => "ID do produto não fornecido"]);
}

$conn->close();

?>

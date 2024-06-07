<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kiwi";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);

    $valor_formatado = (float) $valor;

    $imagem_updated = false;
    $target_file = "";

    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        $imagem_temp = $_FILES["imagem"]["tmp_name"];
        $imagem_name = basename($_FILES["imagem"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $imagem_name;
        
        if (move_uploaded_file($imagem_temp, $target_file)) {
            $imagem_updated = true;

            // Obter o caminho da imagem existente
            $query = "SELECT imagem FROM produtos WHERE id = $id";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $imagem_existente = $row["imagem"];

                // Remover a imagem existente, se necessário
                if (file_exists($imagem_existente)) {
                    unlink($imagem_existente);
                }
            }
        } else {
            echo json_encode(array("message" => "Erro ao fazer upload da nova imagem."));
            exit();
        }
    }

    $update = "UPDATE produtos SET nome='$nome', descricao='$descricao', valor='$valor_formatado'";
    if ($imagem_updated) {
        $update .= ", imagem='$target_file'";
    }
    $update .= " WHERE id='$id'";

    if ($conn->query($update) === TRUE) {
        echo json_encode(["message" => "Produto atualizado com sucesso!"]);
        header('Location: dashboard.php');
    } else {
        echo json_encode(array("message" => "Erro ao atualizar o produto: " . $conn->error));
    }

    $conn->close();
}
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kiwi";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }   

    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        echo "Nome: " . htmlspecialchars($nome) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Senha: " . htmlspecialchars($password) . "<br>";

        $sql = "INSERT INTO users (nome, email, senha) VALUES ('$nome', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo registro criado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Campos obrigatórios não preenchidos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

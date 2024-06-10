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

        // Usando prepared statements para evitar SQL injection
        $stmt = $conn->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $password);

        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Conta criada com sucesso')</script>";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Campos obrigatórios não preenchidos.')</script>";
    }
} else {
    echo "<script>alert('Método de requisição inválido.')</script>";
}
?>

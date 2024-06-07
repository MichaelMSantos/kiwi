<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kiwi";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }   

    $email = $_POST['email'];
    $senha = $_POST['password'];

    if ($email && $senha) {
        $stmt = $conn->prepare("SELECT senha FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['senha'];

            if ($senha === $stored_password) {
                $_SESSION['email'] = $email;
                echo "<script>alert('Entrada validada com sucesso!')</script>";
                echo "<script>window.location.href='index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Email ou senha inválidos!')</script>";
                echo "<script>window.location.href='login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Email ou senha inválidos!')</script>";
            echo "<script>window.location.href='login.php';</script>";
            exit();
        }

        $stmt->close();
    } else {
        echo "<script>alert('Preencha todos os campos!')</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }

    $conn->close();
}
?>

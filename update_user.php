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

if (!isset($_SESSION['email'])) {

    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET nome=?, email=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $_SESSION['email']);
    $stmt->execute();

    $_SESSION['email'] = $email;
    echo "<script>alert('Informações de Usuário atualizao com sucesso!');</script>";
    echo "<script>window.location.href='perfil.php';</script>";
    exit();
}

$conn->close();
?>

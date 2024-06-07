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

$sql = "DELETE FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();

session_destroy(); // Destroi a sessão, deslogando o usuário

header("Location: login.php");
exit();

$conn->close();
?>

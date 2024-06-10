<?php
session_start();

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'kiwi';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados " . $conn->connect_error);
}

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($nova_senha !== $confirmar_senha) {
    echo '<script>alert("As senhas nova e confirmar senha não são iguais."); window.location.href = "perfil.php";</script>';
    exit();
}

$sql = "SELECT senha FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $senha_bd = $user['senha'];

    if ($senha_atual === $senha_bd) {
        $sql_update = "UPDATE users SET senha = ? WHERE email = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", $nova_senha, $email);
        $stmt_update->execute();
        echo '<script>alert("Senha atualizada com sucesso."); window.location.href = "perfil.php";</script>';
    } else {
        echo '<script>alert("Senha atual incorreta.");</script>';
    }
} else {
    echo '<script>alert("Usuário não encontrado."); window.location.href = "perfil.php";</script>';
}

$conn->close();
?>

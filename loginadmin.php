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

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id_user, nome, email, usertype FROM users WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['usertype'] == 1) {
            
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['usertype'] = $user['usertype'];
            header("Location: dashboard.php");
        } else {

           echo "<script>alert('Acesso negado. Você não é um administrador.');</script>";
           echo "<script>'window.location.href='admin.php';</script>";
        }
    } else {
        echo "<script>alert('Email ou senha incorretos');</script>'";
        echo "<script>window.location.href='admin.php';</script>";
    }
} else {
    echo "<script>alert('Email ou senha não foram fornecidos.');</script>";
    echo "<script>'window.location.href='admin.php';</script>";
}

$conn->close();
?>

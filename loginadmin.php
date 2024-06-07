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

    $sql = "SELECT id, nome, email, usertype FROM users WHERE email = ? AND senha = ?";
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
            header("Location: admin_dashboard.php"); // Redirecionar para o dashboard do administrador
        } else {

            $_SESSION['error'] = "Acesso negado. Você não é um administrador.";
            header("Location: login.php");
        }
    } else {
        // Usuário não encontrado, mostrar mensagem de erro
        $_SESSION['error'] = "Email ou senha incorretos.";
        header("Location: login.php");
    }
} else {
    // Caso email ou senha não estejam definidos
    $_SESSION['error'] = "Email ou senha não foram fornecidos.";
    header("Location: login.php");
}

$conn->close();
?>

<?php 
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

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT * from users where email = ? and senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        echo "<script>alert('Esse email ou senha invalidos!')</script>";
        header('location: login.php');
        exit();
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('location: index.php');
        exit();
    }
}
?>


?>
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

    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $password);
    
        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Conta criada com sucesso')</script>";
            $stmt->close();
            $conn->close();
            echo "<script>window.location.href='login.php'</script>";
            exit; 
        } else {
            echo "Erro: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.')</script>";
        echo "<script>window.location.href='login.php'</script>";
        exit; 
    }
    
} else {
    echo "<script>alert('Método de requisição inválido.')</script>";
    echo "<script>window.location.href='login.php'</script>";
    exit; 
}

?>

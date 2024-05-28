<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'kiwi';

    $conn = new mysqli($server, $user, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    } 
    
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["sena"];
    
        $verificar = "SELECT usuarioComum FROM comum WHERE usuarioComum = '$usuarioComum'";
        $result = $conn->query($verificar);
        if ($result->num_rows > 0) {
            echo "<script>alert('Esse usuário já está cadastrado em nosso sistema, insira outro')</script>";
        } else {
    
            // Prepara e executa a query de inserção
            $sql = "INSERT INTO comum (usuarioComum, senhaComum) VALUES ('$usuarioComum', '$senhaComum')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso')</script>";
                echo "<script>window.location.href='cadastrar.php'</script>";
            } else {
                echo "Erro ao inserir dados: " . $conn->error;
            }
        }
        $conn->close();
}


?>
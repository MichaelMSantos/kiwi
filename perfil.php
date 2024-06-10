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

    $email = $_SESSION['email'];

    $sql = "SELECT nome, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Usuário não encontrado.";
        exit();
    }

    $conn->close();
    ?>

    <!DOCTYPE html>
    <html lang="pt-br" data-bs-theme="dark">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/perfil.css">
        <title>Perfil</title>
    </head>

    <body>
        <div class="content-container">
            <nav class="navbar navbar-expand-lg" style="background-color: rgb(39 39 42);">
                <div class="container-fluid d-flex justify-content-between">
                    <div>
                        <a class="navbar-brand" href="#">
                            <img src="./image/arrow-left.svg" alt="" onclick="voltar()">
                        </a>
                    </div>
                    <div>
                        <img src="./image/logo2.png" class="logo" style="height: 50px;">
                    </div>
                    <div>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $user['nome']; ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="logout.php">Deslogar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="cards">
                <div class="card-user card">
                    <h2>Informação de Usuário</h2>
                    <p>Atualize suas informações de usuário</p>
                    <form action="update_user.php" method="POST" class="formulario">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?php echo $user['nome']; ?>">
                        <label class="second-label">Email</label>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>">
                        <button type="submit" id="atualizarNome"> Atualizar </button>
                    </form>
                </div>
                <div class="card-password card">
                    <h2>Senha</h2>
                    <p>Certifique de utilizar uma senha forte para a segurança de sua conta</p>
                    <form action="atualizar_senha.php" method="POST" class="formulario">
                        <label>Senha atual</label>
                        <input type="password" name="senha_atual">
                        <label class="second-label">Nova senha</label>
                        <input type="password" name="nova_senha">
                        <label class="second-label">Confirmar senha</label>
                        <input type="password" name="confirmar_senha">
                        <button type="submit" id="atualizarSenha"> Atualizar </button>
                    </form>
                </div>
                <div class="card-delete card">
                    <h2>Deletar a conta</h2>
                    <p>Atenção! Se excluir sua conta, todas as informações cadastradas serão excluídas de nosso sistema</p>
                    <form id="formExclusao" action="deletar_conta.php" method="POST" class="formulario">
                        <button type="button" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de confirmação de exclusão -->
        <div class="modal fade" id="confirmacaoExclusao" tabindex="-1" aria-labelledby="confirmacaoExclusaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmacaoExclusaoLabel">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="formExclusao" action="deletar_conta.php" method="POST">
                            <button type="submit" class="btn btn-danger" id="btnConfirmarExclusao">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        var btnExcluirConta = document.querySelector('.card-delete button[type="button"]');
        var modalConfirmacao = new bootstrap.Modal(document.getElementById('confirmacaoExclusao'));
        var btnConfirmarExclusao = document.getElementById('btnConfirmarExclusao');
        var formExclusao = document.getElementById('formExclusao');

        btnExcluirConta.addEventListener('click', function () {
            modalConfirmacao.show();
        });

        btnConfirmarExclusao.addEventListener('click', function () {
            formExclusao.submit();
        });
    });
    
    function voltar() {
        window.history.go(-1);
    }
</script>
  

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>

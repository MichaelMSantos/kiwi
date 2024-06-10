<?php
session_start();

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'kiwi';

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Faça o login para continuar');</script>";
    echo "<script>window.location.href='login.php';</script>";
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
?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meus_pedidos.css">
    <title>Meus Pedidos</title>
</head>
<style>
  .status-enviado {
    color: #4dff00;
}

.status-pendente {
    color: #E5C100;
}

.status-cancelado {
    color: red;
}
  
</style>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: rgb(39 39 42);">
        <div class="container-fluid d-flex justify-content-between">
            <div>
                <a class="navbar-brand" href="cliente.php">
                    Voltar ao Início
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
    <div class="container">
        <div class="title">
            Acompanhe seus pedidos
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table" id="productTable">
                    <thead class="table-header">
                        <tr>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";
                        $dbname = "kiwi";
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                        if ($conn->connect_error) {
                            die("Falha na conexão: " . $conn->connect_error);
                        }
                        
                        $email_cliente = $_SESSION['email'];
                        $sql_pedidos = "SELECT * FROM pedidos WHERE email_cliente = ?";
                        $stmt_pedidos = $conn->prepare($sql_pedidos);
                        $stmt_pedidos->bind_param("s", $email_cliente);
                        $stmt_pedidos->execute();
                        $result_pedidos = $stmt_pedidos->get_result();
                        
                        if ($result_pedidos->num_rows > 0) {
                            while ($pedido = $result_pedidos->fetch_assoc()) {
                                $id_pedido = $pedido['id_pedido'];
                                $data_pedido = $pedido['data_pedido'];
                                $total = $pedido['total'];
                            
                                $sql_itens = "SELECT ip.*, p.nome, p.imagem FROM itens_pedido ip JOIN produtos p ON ip.id_produto = p.id WHERE ip.id_pedido = ?";
                                $stmt_itens = $conn->prepare($sql_itens);
                                $stmt_itens->bind_param("i", $id_pedido);
                                $stmt_itens->execute();
                                $result_itens = $stmt_itens->get_result();
                            
                                while ($item = $result_itens->fetch_assoc()) {
                                    $nome_produto = $item['nome'];
                                    $imagem_produto = $item['imagem'];
                                    $quantidade = $item['quantidade'];
                                    $preco_unitario = $item['preco_unitario'];
                                    $status = $item['status'];
                                    $status_class = '';

                                        if ($status == 'Enviado') {
                                            $status_class = 'status-enviado';
                                        } elseif ($status == 'Pendente') {
                                            $status_class = 'status-pendente';
                                        } elseif ($status == 'Cancelado') {
                                            $status_class = 'status-cancelado';
                                        }
                                                                        echo "<tr>
                                        <td><img src='$imagem_produto' alt='$nome_produto' style='height: 50px; width: 70px'></td>
                                        <td>$nome_produto</td>
                                        <td>$data_pedido</td>
                                        <td>$quantidade</td>
                                         <td class='$status_class'>$status</td>
                                    </tr>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum pedido encontrado.</td></tr>";
                        }
                        
                
                        $conn->close();
                        ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex justify-content-center" id="pagination">

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script>
             document.addEventListener("DOMContentLoaded", function () {
            const rowsPerPage = 3;
            const table = document.getElementById("productTable");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
            const pagination = document.getElementById("pagination");
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            let currentPage = 1;

            function displayPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "" : "none";
                });
            }

            function createPaginationItem(page) {
                const li = document.createElement("li");
                li.className = `page-item ${page === currentPage ? "active" : ""}`;
                const a = document.createElement("a");
                a.className = "page-link";
                a.href = "#";
                a.textContent = page;
                a.addEventListener("click", function (e) {
                    e.preventDefault();
                    currentPage = page;
                    updatePagination();
                    displayPage(currentPage);
                });
                li.appendChild(a);
                return li;
            }

            function updatePagination() {
                pagination.innerHTML = "";
                for (let i = 1; i <= pageCount; i++) {
                    pagination.appendChild(createPaginationItem(i));
                }
            }

            updatePagination();
            displayPage(currentPage);
        });
        </script>
</body>

</html>

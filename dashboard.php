<?php 
    session_start();
    if((isset($_SESSION["usertype"]) == "0")){
        echo "<script>alert('Apenas funcionários tem acesso a essa página!');</script>";
        echo "<script>window.location.href='index.php'</script>";
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $server = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "kiwi";

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];

    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);

    $valor_formatado = (float) $valor;

    if (isset($_FILES["imagem"])) {
        if ($_FILES["imagem"]["error"] == 0) {
            $imagem_temp = $_FILES["imagem"]["tmp_name"];
            $imagem_name = basename($_FILES["imagem"]["name"]);
            $target_dir = "uploads/";
            $target_file = $target_dir . $imagem_name;

            if (move_uploaded_file($imagem_temp, $target_file)) {
                $insert = "INSERT INTO produtos (nome, descricao, valor, imagem) VALUES ('$nome', '$descricao', '$valor_formatado', '$target_file')";
                
                if ($conn->query($insert) === TRUE) {
                    echo "Novo produto adicionado com sucesso.";
                } else {
                    echo "Erro: " . $insert . "<br>" . $conn->error;
                }
            } else {
                echo "Erro ao fazer upload da imagem.";
            }
        } else {
            echo "Erro no upload da imagem: " . $_FILES["imagem"]["error"];
        }
    } else {
        echo "Nenhuma imagem foi enviada.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<style>
    .nav-logo {
        height: 4em;
        width: 10rem;
    }
    .description-container {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
</style>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="pedidos_clientes.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Gerenciar Pedidos
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="perfil.php" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                            Perfil
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="cliente.php" class="sidebar-link">
                           Inicio 
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="logout.php" class="sidebar-link">
                        <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar d-flex justify-content-center">
                    <img src="image/logo2.png" class="img-fluid nav-logo" alt="Logo">
                </div>

            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3 mt-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Bem-vindo(a) de volta!, Admin</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabela -->
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">
                                Produtos
                            </h4>
                            <button class="card-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar</button>
                        </div>
                        <div class="card-body">
                            <table class="table" id="productTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Imagem</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $server = "127.0.0.1";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "kiwi";
                                        
                                        $conn = new mysqli($server, $username, $password, $dbname);
                                        
                                        if ($conn->connect_error) {
                                            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                                        }
                                        
                                        $sql = "SELECT id, nome, descricao, valor, imagem FROM produtos";
                                        $result = $conn->query($sql);
                                        
                                        if ($result !== false && $result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $valor = $row['valor'];
                                                if ($valor !== null) {
                                                    $valor_atualizado = number_format($valor, 2, ',', '.');
                                                } else {
                                                    $valor_atualizado = '0,00'; 
                                                }
                                            
                                                echo "<tr>";
                                                echo "<th scope='row'><img class='img-table' src='" . $row['imagem'] . "'></th>";
                                                echo "<td>"; 
                                                $nome = $row['nome'];
                                                if(strlen($nome) > 20) {
                                                    echo substr($nome, 0 , 20). "...";
                                                    echo " <button class='btn btn-link btn-sm view-more' data-bs-toggle='modal' data-bs-target='#descriptionModal' data-description='" . htmlspecialchars($nome) . "'>Ver mais</button>";
                                                } else {
                                                    echo $nome;
                                                }
                                                echo "</td>";
                                                echo "<td>";
                                                $descricao = $row['descricao'];
                                                if (strlen($descricao) > 30) {
                                                    echo substr($descricao, 0, 30) . "...";
                                                    echo " <button class='btn btn-link btn-sm view-more' data-bs-toggle='modal' data-bs-target='#descriptionModal' data-description='" . htmlspecialchars($descricao) . "'>Ver mais</button>";
                                                } else {
                                                    echo $descricao;
                                                }
                                                echo "</td>";
                                                echo "<td>R$ " . $valor_atualizado . "</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-warning edit-btn btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' data-id='" . $row['id'] ."'>Editar</button>";
                                                echo " ";
                                                echo "<button class='btn btn-danger btn-sm btn-excluir' data-id='" . $row['id'] ."'>Excluir</button>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            
                                         } else {
                                            echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
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
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>

      <!-- Modal para exibir a descrição completa -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Descrição Completa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="description-container">
                    <p id="fullDescription"></p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nome do Produto</label>
                            <input type="text" name="nome" class="form-control" id="productName" placeholder="Nome do Produto">
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" id="productDescription" rows="3" placeholder="Descrição do Produto"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Valor</label>
                            <input type="text" name="valor" class="form-control" id="productPrice" placeholder="Valor do Produto" oninput="formatCurrency(this)">
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Imagem do Produto</label>
                            <input type="file" name="imagem" class="form-control" id="productImage">
                        </div>                        
                        <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de Ediçao -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="update_produto.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control" id="editName" name="nome">
                        </div>
                        <div class="mb-3">
                                <label for="editDescription" class="form-label">Descrição</label>
                                <textarea class="form-control" id="editDescription" name="descricao"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editPrice" class="form-label">Valor</label>
                                <input type="text" class="form-control" id="editPrice" name="valor" oninput="formatCurrency(this)">
                            </div>

                                <script>
                                function formatCurrency(input) {
                                    let value = input.value.replace(/\D/g, '');
                                    value = (value / 100).toFixed(2) + '';
                                    value = value.replace(".", ",");
                                    value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                                    input.value = value;
                                }
                                </script>

                        <div class="mb-3">
                            <label for="editImage" class="form-label">Imagem do Produto</label>
                            <input type="file" class="form-control" id="editImage" name="imagem">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script>

document.querySelectorAll('.edit-btn').forEach(item => {
    item.addEventListener('click', event => {
        const id = event.currentTarget.getAttribute('data-id');
        fetch('get_produto.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editId').value = data.id;
                document.getElementById('editName').value = data.nome;
                document.getElementById('editDescription').value = data.descricao;
                document.getElementById('editPrice').value = data.valor;
                document.getElementById('editImage').value = data.imagem;

            });
    });
});

        document.addEventListener("DOMContentLoaded", function () {
    const excluirButtons = document.querySelectorAll(".btn-excluir");

    excluirButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const productId = this.getAttribute("data-id");

            fetch("excluir_produto.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: productId }),
            })
                .then(response => response.json())
                .then(data => {

                    alert(data.message);

                    window.location.reload();
                })
                .catch(error => {
                    console.error("Erro ao excluir o produto:", error);
                    alert("Erro ao excluir o produto. Por favor, tente novamente.");
                });
        });
    });
});

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


document.addEventListener("DOMContentLoaded", function () {
    const viewMoreButtons = document.querySelectorAll(".view-more");

    viewMoreButtons.forEach(button => {
        button.addEventListener("click", function () {
            const description = this.getAttribute("data-description");
            document.getElementById("fullDescription").textContent = description;
        });
    });
});
    </script>

</body>

</html>
<?php 

$conn->close();
?>

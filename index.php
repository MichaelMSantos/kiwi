<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/produtos.css">
    <link rel="stylesheet" href="./css/scrollbar.css">

    <title>Kiwi | Início</title>
</head>

<style>
.accordion-item {
        margin-top: 10px;
    }

    .accordion-button {
        background-color: #131212;
        /* border: #11ff00 1px solid; */
        box-shadow: #11ff00 3px 2px 0px;
        color: #fff;
    }

    .accordion-body {
        transition: all 1s;
        color: #fff;
        box-shadow: #11ff00 1px 1px 0px;
    }

    .accordion-button:not(.collapsed) {
        box-shadow: #11ff00 3px 2px 0px;
        background-color: #131212;
        transition: all .5s;
        color: #fff;
    }

    .accordion-button::after {
        transition: all .5s;
        fill: green;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='green' class='bi bi-plus-lg' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2'/%3E%3C/svg%3E");
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='green' class='bi bi-dash-lg' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8'/%3E%3C/svg%3E");
    }

    .accordion {
        --bs-accordion-btn-focus-box-shadow: #11ff00 3px 2px 0px;
        --bs-accordion-bg: #131212;
    }

    .col {
        text-align: center;
    }

   .redes-sociais i {
        font-size: 28px;
    }
    .title-section-footer a {
        text-decoration: none;
    }

    .btnInicio {
        transition: .2s all;
    }
* {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    .background-kiwi-container {
        width: 100%;
        background: linear-gradient(45deg, #040504, #040504, #195D19, #195D19);
        background-size: 300% 300%;
        animation: color 5s ease-in-out infinite;
    }

    @keyframes color {
        0% {
            background-position: 0 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0 50%;
        }
    }
.background-kiwi {
    background: none;
}
</style>

<body class="h-auto antialiased dark">
    <!-- NAV -->
    <div class="background-nav w-full h-28 flex flex-col items-start">
        <img src="./image/logo2.png" alt="Logo da Kiwi" class="h-16 w-44 pt-3 pl-10">
        <div class="w-full flex items-center pr-12 pl-3">
            <nav class="text-white uppercase text-sm z-10">
                <ul class="flex space-x-12 font-medium">
                    <li class="nav-item">
                        <a href="#produtos" class="nav-link">
                            Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#servicos" class="nav-link">
                            Serviços
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#PORQUEKIWI" class="nav-link">
                            por que kiwi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#ajuda" class="nav-link">
                            ajuda
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="dropdown text-white text-sm font-medium flex items-center ml-auto relative pb-3">
                <button class="dropbtn flex items-center">
                    <img src="./image/user.svg" class="login">
                    Login
                </button>
                <div class="dropdown-content absolute">
                    <a href="login.php">Cliente</a>
                    <a href="admin.html">Administrador</a>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM NAV -->

    <!-- PRODUTOS -->
    <div class="background-kiwi-container">
    <div class="background-kiwi w-full text-center" style="height: 768px;">
        <h2 id="produtos" class="text-white pt-10 pb-12 text-title text-5xl">Nossos <span class="text-title">Produtos</span></h2>

        <div class="produtos swiper-container">
            <div class="swiper-wrapper">
                <?php
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "kiwi";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Falha ao conectar " . $conn->connect_error);
                }

                $sql = "SELECT * FROM produtos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $descricao = $row['descricao'];
                        $descricao_display = '';
                        if (strlen($descricao) > 500) {
                            $descricao_display = substr($descricao, 0, 500) . "... <button class='btn btn-link btn-sm view-more' data-bs-toggle='modal' data-bs-target='#descriptionModal' data-description='" . htmlspecialchars($descricao) . "'>Ver mais</button>";
                        } else {
                            $descricao_display = $descricao;
                        }
                        
                        echo '
                            <aside class="swiper-slide">
                                <div class="card-container">
                                    <div class="card text-white" id="flip-card">
                                        <div class="card-front p-4">
                                            <figure>
                                                <img class="card-image" src="' . $row["imagem"] . '" alt="" title="">
                                                <figcaption class="card-title">' . $row["nome"] . '</figcaption>
                                                <p class="card-price">R$ ' . $row["valor"] . '</p>
                                                <div class="buttons-card">
                                                    <button class="comprar" data-id="' . $row["id"] . '">COMPRAR</button>
                                                    <button class="card-button" onclick="flipCard(this)">Ler</button>
                                                </div>
                                            </figure>
                                        </div>
                                        <div class="card-back flex flex-col p-10">
                                            <p>
                                                <h5>ESPECIFICAÇÕES TÉCNICAS</h5>
                                                ' . $descricao_display . '
                                            </p>
                                            <button class="card-button" onclick="flipCard(this)">Voltar</button>
                                        </div>
                                    </div>
                                </div>
                            </aside>';
                                                    
                    }
                } else {
                    echo "0 resultados";
                }
                $conn->close();
                ?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <!-- Fim Produtos -->

    <!-- Inicio Serviços -->
    <div class="background-kiwi text-white pt-16 pl-20 pr-20" style="height: 920px; width: 100%;">
        <div class="flex flex-col items-center justify-center">
            <hr class="green-line">
            <h1 id="servicos" class="mb-16 pt-10 text-title text-white text-5xl">Nossos <span class="text-title">Serviços</span>
            </h1>

            <ul class="serviços text-xl mb-20" style="list-style-type: circle;">
                <li>Instalação da infraestrutura de rede - Será feito toda a parte de cabeamento e instalação de
                    dispositivos de rede.</li>

                <li>Instalação e Configuração de dispositivos rede - A infreastrutura será instalado e os dispositivos
                    serão
                    configurados para uso no trabalho e para a segurança da empresa.</li>

                <li>Instalação e Configuração de Servidor - Será instalado e configurado o servidor requisitado junto
                    com as
                    funções necessárias para funcionamento na área de trabalho em especifico.</li>
            </ul>
            <div class="porque">
                <div class="flex flex-col items-center justify-center">
                    <hr class="green-line">
                    <h1 id="PORQUEKIWI" class="text-5xl pb-10 pt-10 text-title text-white">Por que <span
                            class="text-title">Kiwi?</h1>
                </div>
                <p class="TextoKiwi" style="text-align: justify;">
                    Com a Kiwi podemos trazer a sua empresa uma qualidade de serviço que não se encontra em outras
                    empresas,
                    sempre procurando a fazer o melhor atendimento, plano e serviço ao nosso cliente, melhorando sua
                    velocidade
                    de rede, segurança dos seus dados e instalações de dispositivos de rede.
                </p>

                <P class="TextoKiwi" style="text-align: justify;">
                    Visamos ser a melhor empresa de serviços de rede, com isso a Kiwi irá eternamente procurar superar
                    suas
                    expectativas para o futuro de sua empresa.
                </p>
                <div class="flex flex-col items-center justify-center pt-10 pb-10">
                    <hr class="green-line">
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Serviços -->

    <!-- FAQ -->
    <div id="ajuda" class="faq background-kiwi gradient-effect" style="height: 378px;">
        <h1 class="text-title text-center text-5xl pb-10">
            Perguntas Frequentes
        </h1>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Quanto tempo dura a garantia dos produtos?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">
                                    A duração da garantia varia conforme o produto e o fabricante. A maioria dos nossos produtos vem com uma garantia mínima de 12 meses.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Como faço para devolver ou trocar um produto?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                Para devolver ou trocar um produto, entre em contato com nosso suporte ao cliente pelo email <span class="text-title">suporte@kiwi.com</span>. Informe o motivo da devolução ou troca dentro do prazo de 30 dias após a entrega.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="accordion accordion-flush" id="accordionFlushExample3">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    Posso alterar ou cancelar meu pedido após a confirmação?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample3">
                                <div class="accordion-body">
                                Trabalhamos para processar os pedidos o mais rápido possível, por isso, as alterações ou cancelamentos só são permitidos dentro de um curto período após a confirmação do pedido.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    <!-- Fim FAQ -->

        <!-- AJUDA -->
        <div class="primary footer" style="height: 320px;">
        <button
            class="btnInicio navbar text-gray-300 navbar-expand-lg flex justify-content-center w-full h-12 bg-gray-800 hover:bg-gray-700"
            onclick="screenTop()">
            Voltar ao início
        </button>
        <div class="container-footer flex justify-content-center flex-col">
            <div class="row p-10 title-section-footer">
                <div class="col">
                    <p class="footer-titles text-xl uppercase font-medium text-gray-300">
                        Central de vendas
                    </p>
                    <a href="https://api.whatsapp.com/send?phone=SEUNUMEROAQUI" target="_blank" class="text-lg text-gray-400">Compre pelo Whatsapp<i class="ml-2 bi bi-whatsapp text-gray-400"></i></a>
                </div>
                <div class="col">
                    <p class="footer-titles text-xl uppercase font-medium text-gray-300">
                        Meus pedidos
                    </p>
                    <a href="" class="text-lg text-gray-400">Acompanhe seu pedido</a>
                </div>
                <div class="col">
                    <p class="footer-titles text-xl uppercase font-medium text-gray-300">
                        Central de atendimento
                    </p>
                    <p class="text-lg text-gray-400 font-medium">0000-0000 <a href="https://api.whatsapp.com/send?phone=SEUNUMEROAQUI" target="_blank" class="pl-3 text-gray-400">Fale pelo Whatsapp<i class="ml-1 bi bi-whatsapp text-gray-400"></i></a></p>
                </div>
            </div>
            <div class="redes-sociais mt-11">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <a href="#" target="_blank" class="mr-3"><i
                                class="bi bi-facebook text-gray-300"></i></a>
                        <a href="#" target="_blank" class="mr-3"><i
                                class="bi bi-linkedin text-gray-300"></i></a>
                        <a href="#" target="_blank" class="mr-3"><i
                                class="bi bi-envelope-fill text-gray-300"></i></a>
                        <a href="https://api.whatsapp.com/send?phone=SEUNUMEROAQUI" target="_blank"
                            style="text-decoration: none;"><i class="bi bi-whatsapp text-gray-300"></i></a>
                    </div>
                 </div>
            </div>

         </div>
    </div>
    <!-- Fim AJUDA-->

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

    <!-- Modal do botao comprar -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login Requerido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Por favor, faça login para continuar.
                </div>
                <div class="modal-footer">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/gradient.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const comprarButtons = document.querySelectorAll('.comprar');

            comprarButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                    loginModal.show();
                });
            });
        });

        function screenTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function flipCard(button) {
            const card = button.closest('.card');
            card.classList.toggle('is-flipped');
        }

        window.onload = function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 10,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 10,
                    },
                    1280: {
                        slidesPerView: 4,
                        spaceBetween: 10,
                    },
                }
            });

            const viewMoreButtons = document.querySelectorAll('.view-more');
            const fullDescription = document.getElementById('fullDescription');

            viewMoreButtons.forEach(button => {
                button.addEventListener('click', function() {
                    fullDescription.innerHTML = this.getAttribute('data-description');
                });
            });
        }
    </script>
</body>

</html>
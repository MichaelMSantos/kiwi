<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .form-container,
        .cadastro {
            transition: transform 0.5s ease-in-out;
        }

        .svg-green {
            fill: green;
        }
    </style>
</head>

<body class="primary h-full">
    <div class="w-full flex items-center">
        <div class="flex-1">
            <a href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-arrow-left svg-green ml-16" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            </a>
        </div>
        <div class="flex-1 flex justify-center">
            <img src="image/logo2.png" class="h-14 w-44" style="margin-top: 23px;">
        </div>
        <div class="flex-1">
            <!-- Espaço vazio para centralização -->
        </div>
    </div>
    <div class="flex justify-center">
        <div class="container gap-20">
            <div class="login ml-20 form-container">
                <form id="loginForm" class="flex flex-col" action="logar.php" method="POST">
                    <p id="formTitle" class="text-3xl tracking-widest font-bold uppercase pb-10 text-center text-login">Login</p>
                    <div id="novoInput" style="display: none;" class="pb-5">
                        <label class="label text-white" name="nome">Nome</label>
                        <input id="newInput" type="text" name="nome" class="h-8" disabled>
                    </div>
                    <label class="label text-white">E-mail</label>
                    <input type="email" name="email" class="h-8">
                    <label class="label pt-5 text-white">Senha</label>
                    <input type="password" name="password" class="h-8">
                    <input type="submit" value="entrar"
                        class="mt-9 h-8 w-56 uppercase rounded-full mx-auto tracking-wider antialiased">
                    <a href="index.php" class="text-white uppercase text-sm text-center pt-9">voltar</a>
                </form>
            </div>
            <div class="cadastro flex flex-col items-center ml-20 mt-12">
                <h1 class="text-3xl text-center font-bold antialiased slogan">
                    Seja Bem-Vindo(a) de volta!!
                </h1>
                <h3 class="mt-10 text-center text-2xl font-bold antialiased slogan-2">
                    Primeiro acesso?
                </h3>
                <h4 class="mt-7 w-64 text-center text-xl slogan-3">
                    Clique aqui para fazer o cadastro em nossa empresa
                </h4>

                <h2 class="cadastrar mt-5 text-2xl font-bold antialiased">
                    <a href="#" id="toggleButton">Cadastre-se</a>
                </h2>
            </div>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggleButton');
        const login = document.querySelector('.login');
        const cadastro = document.querySelector('.cadastro');
        const novoInput = document.getElementById('novoInput');
        const newInput = document.getElementById('newInput');
        const formContainer = document.querySelector('.form-container');
        const formTitle = document.getElementById('formTitle');
        const textlogin = document.querySelector('.text-login');
        const slogan = document.querySelector('.slogan');
        const slogan2 = document.querySelector('.slogan-2');
        const slogan3 = document.querySelector('.slogan-3');
        const loginForm = document.getElementById('loginForm');

        let isLoginFirst = true;

        toggleButton.addEventListener('click', (event) => {
            event.preventDefault();
            console.log('Toggle clicked');

            if (isLoginFirst) {
                console.log('Switching to Cadastro');
                formContainer.style.transform = 'translateX(150%)';
                cadastro.style.transform = 'translateX(-120%)';
                novoInput.style.display = 'block';
                newInput.removeAttribute('disabled');
                toggleButton.innerText = 'Faça o login';
                formTitle.innerText = 'Cadastro';
                slogan.innerText = 'Faça o cadastro para aproveitar nossos produtos e serviços';
                slogan2.style.display = 'none';
                slogan3.innerText = 'Já possui conta?';
                loginForm.action = "cadastrar.php";
            } else {
                console.log('Switching to Login');
                formContainer.style.transform = 'translateX(0%)';
                cadastro.style.transform = 'translateX(0%)';
                login.style.order = '1';
                cadastro.style.order = '2';
                novoInput.style.display = 'none';
                newInput.setAttribute('disabled', 'true');
                toggleButton.innerText = 'Cadastre-se';
                formTitle.innerText = 'Login';
                slogan.innerText = 'Seja Bem-Vindo(a) de Volta!!';
                slogan2.style.display = 'block';
                slogan3.innerText = 'Clique aqui para fazer o cadastro em nossa empresa';
                loginForm.action = "logar.php";
            }

            isLoginFirst = !isLoginFirst;
            console.log('isLoginFirst:', isLoginFirst);
        });
    </script>
</body>

</html>


<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Administrador</title>
</head>
<style>
    .form-container,
    .cadastro {
        transition: transform 0.5s ease-in-out;
    }

    .svg-green {
            fill: green;
        }
</style>

<body class="primary h-full">
<div class="w-full flex justify-between pr-12 pl-12 pt-5">
        <div class="">
            <a href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-arrow-left svg-green ml-16" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            </a>
        </div>
        <div class="justify-center">
            <img src="image/logo2.png" class="h-14 w-44">
        </div>
        <div class="text-white admin">
            <a href="login.php">Cliente</a>
        </div>
    </div>
    <div class="flex justify-center">
        <div class="container mx-auto">
            <div class="login form-container">
                <form id="loginForm" class="flex flex-col" method="POST" action="loginadmin.php">
                    <p class="text-3xl tracking-widest font-bold uppercase pb-10 text-center text-login">Administrador</p>
                    <div id="novoInput" style="display: none;" class="pb-5">
                        <input id="newInput" type="text" name="newInput" class="h-8" disabled>
                    </div>
                    <label class="label text-white">Email</label>
                    <input type="email" name="name" class="h-8">
                    <label class="label pt-5 text-white">Senha</label>
                    <input type="password" name="password" class="h-8">
                    <input type="submit" value="entrar"
                        class="mt-9 h-8 w-56 uppercase rounded-full mx-auto tracking-wider antialiased">
                    <a href="index.php" class="text-white uppercase text-sm text-center pt-9">voltar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
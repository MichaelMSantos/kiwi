
    const toggleButton = document.getElementById('toggleButton');
    const login = document.querySelector('.login');
    const cadastro = document.querySelector('.cadastro');
    const novoInput = document.getElementById('novoInput');
    const newInput = document.getElementById('newInput');
    const formContainer = document.querySelector('.form-container');
    const textlogin = document.querySelector('.text-login');
    const slogan = document.querySelector('.slogan');
    const slogan2 = document.querySelector('.slogan-2');
    const slogan3 = document.querySelector('.slogan-3');

    let isLoginFirst = true;

    toggleButton.addEventListener('click', (event) => {
        event.preventDefault();

        if (isLoginFirst) {
            formContainer.style.transform = 'translateX(150%)';
            cadastro.style.transform = 'translateX(-120%)';
            novoInput.style.display = 'block';
            newInput.removeAttribute('disabled');
            toggleButton.innerText = 'Faça o login';
            textlogin.innerText = 'Cadastro';
            slogan.innerText = 'Faça o cadastro para aproveitar nossos produtos e serviços';
            slogan2.style.display = 'none';
            slogan3.innerText = 'Já possui conta?';
            document.getElementById('loginForm').action = "../config/cadastrar.php";
        } else {
            formContainer.style.transform = 'translateX(0%)';
            cadastro.style.transform = 'translateX(0%)';
            login.style.order = '1';
            cadastro.style.order = '2';
            novoInput.style.display = 'none';
            newInput.setAttribute('disabled', 'true');
            toggleButton.innerText = 'Cadastre-se';
            textlogin.innerText = 'Login';
            slogan.innerText = 'Seja Bem-Vindo(a) de Volta!!';
            slogan2.style.display = 'block';
            slogan3.innerText = 'Clique aqui para fazer o cadastro em nossa empresa';
            document.getElementById('loginForm').action = "logar.php";
        }

        isLoginFirst = !isLoginFirst;
    });
<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<html>
    <body>
        <form class="login" style="margin-top: 15%;" method="POST" action="{{ route('login.store') }}" onsubmit="validarLogin(event)">
            @csrf

            <div class="title">
                Login
            </div>

            <input id="username" name="username" type="text" placeholder="Nome de utilizador" autocomplete="off">
            <input id="password" name="password" type="password" placeholder="Palavra-passe" autocomplete="off">

            <div class="buttons">
                <button type="submit">Entrar</button>
                <button type="button" onclick="goToRegister()">Registar</button>
            </div>
        </form>

        <script>
            function goToRegister(){
                limparCampos()
                window.location.href = "{{ route('register') }}";
            }

            function goToMain(){
                limparCampos()
                window.location.href = "{{ route('main') }}";
            }

            function limparCampos(){
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
            }

            function mensagemDeErro(dados){
                if (dados.errors){
                    return Object.values(dados.errors).flat().join("\n");
                }

                return dados.message ?? "Ocorreu um erro inesperado.";
            }

            async function validarLogin(event){
                event.preventDefault();
                const username = document.getElementById("username").value;
                const password = document.getElementById("password").value;

                if (username === "" || password === ""){
                    alert("Por favor, preencha todos os campos.");
                    return;
                }

                const resposta = await fetch("{{ route('login.store') }}",{
                    method: "POST",
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({ username, password }),
                });

                if (!resposta.ok){
                    const dados = await resposta.json();
                    alert(mensagemDeErro(dados));
                    limparCampos();
                    return;
                }

                goToMain();
            }
        </script>
    </body>
</html>

<html>
    <style>
        body{
            background-color: #000000;
            color: #ffffff;
            font-family: Roboto, sans-serif;
        }

        input{
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 300px;
        }

        button{
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 120px;
            background-color: #ffffff;
            color: #000000;
            font-weight: 400;
            cursor: pointer;
        }

        .login{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .title{
            font-size: 67px;
            font-weight: 600;
            letter-spacing: 5px;
            margin: 10px;
        }

        .buttons{
            display: flex;
            justify-content: space-around;
            padding: 10px;
            width: 300px;
        }
        
    </style>
    <body>
        <form class="login" style="margin-top: 15%;" method="POST" action="{{ route('login.store') }}" onsubmit="validarLogin(event)">
            @csrf
            <div class="title">Login</div>
            <input id="username" name="username" type="text" placeholder="Nome de utilizador">
            <input id="password" name="password" type="password" placeholder="Palavra-passe">
            <div class="buttons">
                <button type="submit">Entrar</button>
                <button type="button" onclick="goToRegister()">Registar</button>
            </div>
        </form>
        
        <script>
            function goToRegister() {
                window.location.href = "{{ route('register') }}";
            }
            
            function goToMain() {
                window.location.href = "{{ route('main') }}";
            }

            function limparCampos() {
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
            }

            async function validarLogin(event) {
                event.preventDefault();
                const username = document.getElementById("username").value;
                const password = document.getElementById("password").value;

                if (username === "" || password === "") {
                    alert("Por favor, preencha todos os campos.");
                    return;
                }

                const resposta = await fetch("{{ route('login.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({ username, password }),
                });

                if (!resposta.ok) {
                    const dados = await resposta.json();
                    alert(dados.message);
                    limparCampos();
                    return;
                }

                goToMain();
            }
        </script>
    </body>    
</html>
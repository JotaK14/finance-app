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
        .register{
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
        .erros{
            width: 300px;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #3d0000;
            color: #ffb4b4;
            font-size: 14px;
        }
    </style>
    <body>
        <form class="register" style="margin-top: 12%;" method="POST" action="{{ route('register.store') }}" onsubmit="validarRegisto(event)">
            @csrf

            <div class="title">Registo</div>
            <input id="username" name="username" type="text" placeholder="Nome de utilizador">
            <input id="phoneNumber" name="phoneNumber" type="tel" placeholder="Número de telemóvel" maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input id="password" name="password" type="password" placeholder="Palavra-passe">
            <input id="confirmPassword" name="password_confirmation" type="password" placeholder="Confirmar Palavra-passe">

            <div class="buttons">
                <button id="registerButton" type="submit">Registar</button>
                <button id="backButton" type="button" onclick="goToLogin()">Voltar</button>
            </div>
        </form>

        <script>
            function goToLogin() {
                window.location.href = "{{ route('login') }}";
            }

            function limparCampos() {
                document.getElementById("username").value = "";
                document.getElementById("phoneNumber").value = "";
                document.getElementById("password").value = "";
                document.getElementById("confirmPassword").value = "";
            }

            async function validarRegisto(event) {
                event.preventDefault();

                const username = document.getElementById("username").value;
                const phoneNumber = document.getElementById("phoneNumber").value;
                const password = document.getElementById("password").value;
                const password_confirmation = document.getElementById("confirmPassword").value;

                if (username === "" || phoneNumber === "" || password === "" || password_confirmation === "") {
                    alert("Por favor, preencha todos os campos.");
                    return;
                }
                if (username.length < 4 || username.length > 20) {
                    alert("O nome de utilizador deve ter entre 4 e 20 caracteres.");
                    return;
                }
                if (!username.match(/^[a-zA-Z0-9]+$/)) {
                    alert("O nome de utilizador deve conter apenas letras e números.");
                    return;
                }
                if (username.match(/^[a-zA-ZÀ-ÿ]+$/) || username.match(/^[0-9]+$/)) {
                    alert("O nome de utilizador não pode conter apenas letras ou números.");
                    return;
                }
                if (password !== password_confirmation) {
                    alert("As palavras-passe não coincidem.");
                    return;
                }
                if (password.length < 6) {
                    alert("A palavra-passe deve ter pelo menos 6 caracteres.");
                    return;
                }
                if (password.match(/^[a-zA-Z]+$/) || password.match(/^[0-9]+$/)) {
                    alert("A palavra-passe deve conter pelo menos uma letra e um número.");
                    return;
                }
                const resposta = await fetch("{{ route('register.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({username, phoneNumber, password, password_confirmation}),
                });

                if (!resposta.ok) {
                    const dados = await resposta.json();
                    alert(dados.message);
                    limparCampos();
                    return;
                }

                goToLogin();
            }
        </script>
    </body>
</html>

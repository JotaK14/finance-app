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
        <div class="login" style="margin-top: 15%;"> 
            <div class="title">Login</div>
            <input type="text" placeholder="Nome de utilizador">
            <input type="password" placeholder="Palavra-passe">
            <div class="buttons">
                <button onclick="goToMain()">Entrar</button>
                <button onclick="goToRegister()">Registar</button>
            </div>
        </div>
        
        <script>
            function goToMain() {
                window.location.href = "{{ route('main') }}";
            }

            function goToRegister() {
                window.location.href = "{{ route('register') }}";
            }
        </script>
    </body>    
</html>
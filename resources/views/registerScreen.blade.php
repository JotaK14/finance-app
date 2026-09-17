<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<html>
    <body>
        <form class="register" style="margin-top: 12%;" method="POST" action="{{ route('register.store') }}" onsubmit="validarRegisto(event)">
            @csrf

            <div class="title">Registo</div>

            <input id="username" name="username" type="text" placeholder="Nome de utilizador" autocomplete="off">
            <input id="password" name="password" type="password" placeholder="Palavra-passe" autocomplete="off">
            <input id="confirmPassword" name="password_confirmation" type="password" placeholder="Confirmar Palavra-passe" autocomplete="off">

            <div class="buttons">
                <button id="registerButton" type="submit">Registar</button>
                <button id="backButton" type="button" onclick="goToLogin()">Voltar</button>
            </div>
        </form>

        <script src="{{ asset('js/register.js') }}"></script>
    </body>
</html>

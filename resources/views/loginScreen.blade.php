<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
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

            <a class="link" href="{{ route('password.request') }}">Esqueceu-se da password?</a>
        </form>

        @include('components.loading-overlay')

        <script src="{{ asset('js/loading.js') }}"></script>
        <script src="{{ asset('js/login.js') }}"></script>
    </body>
</html>

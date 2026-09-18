<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
<link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
<html>
    <body>
        <form class="forgot-password" style="margin-top: 15%;" method="POST" action="{{ route('password.email') }}" onsubmit="enviarLink(event)">
            @csrf

            <div class="title">
                Recuperar
            </div>

            <div class="texto">
                Indique o email da sua conta e enviamos-lhe um link para definir uma nova palavra-passe.
            </div>

            <input id="email" name="email" type="email" placeholder="Email" autocomplete="off">

            <div class="buttons">
                <button type="submit">Enviar</button>
                <button type="button" onclick="goToLogin()">Voltar</button>
            </div>
        </form>

        @include('components.loading-overlay')

        <script src="{{ asset('js/loading.js') }}"></script>
        <script src="{{ asset('js/forgot-password.js') }}"></script>
    </body>
</html>

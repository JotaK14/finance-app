<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
<link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
<html>
    <body>
        <form class="reset-password" style="margin-top: 15%;" method="POST" action="{{ route('password.update') }}" onsubmit="guardarNovaPassword(event)">
            @csrf
            <input type="hidden" id="token" value="{{ $token }}">

            <div class="title">
                Nova Password
            </div>

            <input id="email" name="email" type="email" placeholder="Email" autocomplete="off" value="{{ $email }}">
            <input id="password" name="password" type="password" placeholder="Nova palavra-passe" autocomplete="off">
            <input id="confirmPassword" name="password_confirmation" type="password" placeholder="Confirmar palavra-passe" autocomplete="off">

            <div class="buttons">
                <button type="submit">Guardar</button>
                <button type="button" onclick="goToLogin()">Cancelar</button>
            </div>
        </form>

        @include('components.loading-overlay')

        <script src="{{ asset('js/loading.js') }}"></script>
        <script src="{{ asset('js/reset-password.js') }}"></script>
    </body>
</html>

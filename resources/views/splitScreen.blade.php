<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('css/split.css') }}">
<html>
    <body>
        <div class="title" style="margin-top: 20%;">
            Finance App
        </div>

        <div class="subtitle">
            Aplicação de apoio financeiro
        </div>

        <script>
            setTimeout(() =>{
                window.location.href = "{{ route('login') }}";
            }, 3000);
        </script>
    </body>
</html>

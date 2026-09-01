<link rel="stylesheet" href="{{ asset('css/colors.css') }}">
<html>
    <style>
        body{
            background-color: var(--preto);
            color: var(--branco);
            font-family: Roboto, sans-serif;
            letter-spacing: 5px;
        }

        .title{
            display: flex;
            justify-content: center;
            font-size: 67px;
            font-weight: 600;
        }

        .subtitle{
            display: flex;
            justify-content: center;
            font-size: 20px;
            font-weight: 400;
        }

    </style>
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

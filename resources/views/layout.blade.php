<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Séries</title>
    <script src="https://kit.fontawesome.com/1e10a4bc0f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark d-flex justify-content-between">
    <a class="navbar navbar-brand bg-primary" href="{{ route('listar_series') }}">Home</a>
    @auth
    <a href="/sair" class="navbar navbar-brand bg-danger" >Sair</a>
    @endauth
    @guest
    <a href="/entrar" class="navbar navbar-brand bg-primary" >Entrar</a>
    @endguest
</nav>
    <div class="container">
        <div class="jumbotron mt-2">
            <h1>@yield('cabecalho')</h1>
        </div>
        @yield('conteudo')
    </div>
</body>
</html>

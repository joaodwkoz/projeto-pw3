<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('css/login.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>

    <div class="app" id="appImage">
        <h1 class="slogan">O MELHOR LUGAR PARA UM CINEMINHA</h1>
    </div>

    <div class="app" id="form">
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            
            <h1 class="titulo">Bem vindo de volta!</h1>

            @if ($errors->any())
                <div style="color: red;">
                    {{ $errors->first() }}
                </div>
            @endif

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="inEmail">
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Senha" value="" class="inSenha">
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror

            <button class="btn" type="submit" >Entrar</button>

            <p class="txtCadas">Ainda não tem login? <a href="{{route('cadastro')}}" class="Cadas">Cadastre-se aqui</a></p>
        </form>
    </div>
    
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
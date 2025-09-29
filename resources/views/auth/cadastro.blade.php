<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('css/cadastro.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body>

    <div class="app" id="appImage">
        <h1 class="slogan">O MELHOR LUGAR PARA UM CINEMINHA</h1>
    </div>

    <div class="app" id="form">

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <h1 class="titulo">Bem vindo!!</h1>
            

        
            <input type="text" placeholder="Nome de usuario" class="inEmail" name="name" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="email" placeholder="Email" class="inEmail" name="email" required>
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input type="password" placeholder="Senha" class="inSenha" name="password" required>
             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <input type="password" placeholder="Confirmar senha" class="inSenha" name="password_confirmation" required>
             @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button class="btn" type="submit">Entrar</button>

            <p class="txtCadas">Já tem uma conta? <a href="{{ route('login') }}" class="Cadas">Fazer Login</a></p>
        </form>
    </div>
    
</body>
</html>
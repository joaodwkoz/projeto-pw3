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

    <!-- Bloco para exibir mensagens de sucesso (enviadas após redirecionamento do Controller) -->
    @if(session('mensagem'))
    {{-- Certifique-se de estilizar essas classes no seu cadastro.css para que a mensagem apareça formatada. --}}
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('mensagem') }}</span>
    </div>
    @endif

    <!-- Bloco para exibir erros gerais, caso a validação falhe -->
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Houve um erro!</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="app" id="appImage">
        <h1 class="slogan">O MELHOR LUGAR PARA UM CINEMINHA</h1>
    </div>

    <div class="app" id="form">

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <h1 class="titulo">Bem vindo!!</h1>
            
            {{-- Input Nome: Usa old() para persistir o valor e @error para mostrar o erro específico --}}
            <input type="text" placeholder="Nome de usuario" class="inEmail @error('name') is-invalid @enderror" name="name" required value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Input Email --}}
            <input type="email" placeholder="Email" class="inEmail @error('email') is-invalid @enderror" name="email" required value="{{ old('email') }}">
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Input Senha --}}
            <input type="password" placeholder="Senha" class="inSenha @error('password') is-invalid @enderror" name="password" required>
             @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            {{-- Input Confirmação de Senha --}}
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
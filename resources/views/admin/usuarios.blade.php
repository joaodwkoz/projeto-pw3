<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard-components.css') }}">
</head>
<body>
    <div id="dashboard">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{route('dashboard.index')}}">
                        <div class="icon">
                            <img src="{{ url('imgs/side-home.png')}}" alt="">
                        </div>

                        <span class="text">Home</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ url('imgs/side-movies.png')}}" alt="">
                        </div>

                        <span class="text">Filmes</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ url('imgs/side-users.png')}}" alt="">
                        </div>

                        <span class="text">Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ url('imgs/side-reviews.png')}}" alt="">
                        </div>

                        <span class="text">Avaliações</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ url('imgs/side-lists.png')}}" alt="">
                        </div>

                        <span class="text">Listas</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.contatos')}}">
                        <div class="icon">
                            <img src="{{ url('imgs/side-contacts.png')}}" alt="">
                        </div>

                        <span class="text">Contatos</span>
                    </a>
                </li>
            </ul>

            <div class="profile-content">
                <div class="profile">
                    <div class="profile-icon"></div>

                    <span class="profile-name">
                        João Pedro
                    </span>
                </div>

                <div class="log-out">
                    <div class="icon">
                        <img src="{{ url('imgs/side-logout.png')}}" alt="">
                    </div>

                    <span class="text">Sair</span>
                </div>
            </div>
        </aside>
        
        <main id="app">
            <span class="title">Lista de usuários</span>

            <div id="list">
                <div class="header">
                    <div class="category" style="width: 260px;">
                        <span>Nome</span>
                    </div>

                    <div class="category" style="width: 380px;">
                        <span>Email</span>
                    </div>

                    <div class="category" style="width: 360px;">
                        <span>Senha</span>
                    </div>

                    <div class="category" style="width: 120px;">
                        <span>Ações</span>
                    </div>
                </div>

                <div class="data">
                    @foreach($usuarios as $usuario)
                        <div class="row" data-user-id="{{ $usuario->id }}" data-user-name="{{ $usuario->nome }}">
                            <div class="info" style="width: 260px;">
                                <span>{{$usuario->nome}}</span>
                            </div>

                            <div class="info" style="width: 380px;">
                                <span>{{$usuario->email}}</span>
                            </div>

                            <div class="info" style="width: 360px;">
                                <span>{{str_repeat('•', strlen($usuario->senha))}}</span>
                            </div>

                            <div class="info acoes" style="width: 120px;">
                                <button class="read-btn">
                                    <img src="{{url('imgs/admin-ver.png')}}" alt="">
                                </button>

                                <button class="delete-btn">
                                    <img src="{{url('imgs/admin-deletar.png')}}" alt="">
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    <div id="alert-modal-fade" class="hidden">
        <div class="alert-modal">
            <div class="close">
                <button id="close-modal-btn">
                    <img src="{{ url('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="alert-content">
                <span>Deseja remover este usuário?</span>

                <div class="alert-input">
                    <div class="alert-input-text">
                        <span class="normal">Digite o nome de usuário - </span>

                        <span class="bold">"João Pedro"</span>
                    </div>

                    <input type="text" placeholder="João Pedro">
                </div>

                <div class="btns">
                    <button id="cancel-btn">
                        <span>Cancelar</span>
                    </button>

                    <button id="continue-btn" type="submit">
                        <span>Continuar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ url('js/modal.js') }}"></script>
</body>
</html>
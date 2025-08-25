<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}">
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
                    <a href="{{route('dashboard.avaliacoes')}}">
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
            <span class="title">Lista de contatos</span>

            <div id="list">
                <div class="header">
                    <div class="category" style="width: 220px;">
                        <span>Nome</span>
                    </div>

                    <div class="category" style="width: 240px;">
                        <span>Email</span>
                    </div>

                    <div class="category" style="width: 144px;">
                        <span>Filme</span>
                    </div>

                    <div class="category" style="width: 320px;">
                        <span>Descrição</span>
                    </div>

                    <div class="category" style="width: 210px;">
                        <span>Avaliação</span>
                    </div>
                </div>

                <div class="data">
                    @foreach($contatos as $contato)
                        <div class="row">
                            <div class="info" style="width: 220px;">
                                <span>{{$contato->nome}}</span>
                            </div>

                            <div class="info" style="width: 240px;">
                                <span>{{$contato->email}}</span>
                            </div>

                            <div class="info assunto {{ $contato->assuntoClass() }}" style="width: 144px;">
                                <div class="box">
                                    <span>{{$contato->assuntoTexto()}}</span>
                                </div>
                            </div>

                            <div class="info" style="width: 320px;">
                                <span>{{$contato->mensagem}}</span>
                            </div>
                            
                            <div class="info status solved" style="width: 210px;">
                                <div class="box">
                                    <span>Resolvido</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</body>
</html>
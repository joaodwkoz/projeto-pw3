<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/perfil.css') }}">
</head>
<body>
    <div id="perfil">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-home.png')}}" alt="Ícone da Home">
                        </div>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('filmes') }}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-movies.png')}}" alt="Ícone de Filmes">
                        </div>
                        <span class="text">Filmes</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-lists.png')}}" alt="Ícone de Listas">
                        </div>
                        <span class="text">Listas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sobre') }}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-info.png')}}" alt="Ícone de Informações">
                        </div>
                        <span class="text">Sobre</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contato') }}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-contacts.png')}}" alt="Ícone de Contato">
                        </div>
                        <span class="text">Contato</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-users.png')}}" alt="Ícone de Perfil">
                        </div>
                        <span class="text">Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-settings.png')}}" alt="Ícone de Configurações">
                        </div>
                        <span class="text">Configurações</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main id="app" data-api-url="{{ url('api/filmes/genero') }}" data-storage-url="{{ asset('storage') }}">
           <header>
               <div class="search-bar">
                    <div class="icon">
                    <img src="{{ url('imgs/search-icon.png')}}" alt="">
                    </div>
                    <input type="text" placeholder="Pesquisar por filmes, diretores, etc.">
               </div>

               <div class="profile-container">
                   <button class="notifications">
                        <img src="{{ url('imgs/notifs-bell.png') }}" alt="">
                   </button>

                   <button class="profile">
                        <span>{{ Auth::user()->nome }}</span>
                   </button>

                   <div class="profile-menu hidden">
                       <a href="#">Ver perfil</a>

                       @auth
                            @if(auth()->user()->ehAdmin == 1)
                                <a href="{{ route('dashboard.index') }}">Admin</a>         
                            @endif
                       @endauth

                       <a href=""
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                   </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
               </div>
            </header>

            <div class="content">
                <div class="user-profile">
                    <div class="user">
                        <div class="user-img"></div>

                        <span class="user-name">João Pedro</span>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active">
                        <span class="tab-name">
                            Atividades
                        </span>
                    </div>

                    <div class="tab">
                        <span class="tab-name">
                            Filmes assistidos
                        </span>
                    </div>

                    <div class="tab">
                        <span class="tab-name">
                            Avaliação
                        </span>
                    </div>

                    <div class="tab">
                        <span class="tab-name">
                            Listas
                        </span>
                    </div>

                    <div class="line"></div>
                </div>

                <div class="tab-content">
                    <div class="activities">
                        <div class="activity">
                            <div class="activity-data">
                                <div class="activity-user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">assistiu o filme</span>
                                </div>

                                <span class="date">há 1h</span>
                            </div>

                            <div class="activity-movie">
                                <div class="movie-img"></div>

                                <span class="movie-name">A noite dos esquecidos (2001)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
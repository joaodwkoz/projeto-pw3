<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="filmes">
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
                    <a href="{{ route('filmes') }}" class="active">
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
                    <a href="#">
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
                <div class="popular-container">
                    <div class="popular">
                        <div class="img">
                            <img src="{{ asset('storage/' . $filmePopular->banner) }}" alt="Banner do filme {{ $filmePopular->nome }}">
                        </div>

                        <div class="info">
                            <div class="movie-title">
                                <span class="movie-name">{{ $filmePopular->nome }}</span>

                                <span class="movie-date">({{ $filmePopular->ano_lancamento }})</span>
                            </div>

                            <div class="movie-genres">
                                @foreach($filmePopular->generos as $genero)
                                <div class="movie-genre">
                                    <span>{{ $genero->nome }}</span>
                                </div>
                                @endforeach
                            </div>

                            <span class="movie-director">{{ $filmePopular->diretor }}</span>

                            <span class="movie-sinopse">
                                {{ $filmePopular->sinopse }}
                            </span>

                            <div class="actions">
                                <a id="watch-trailer-btn" href="{{ $filmePopular->trailer }}" target="_blank">
                                    <div class="icon">
                                        <img src="{{ url('imgs/watch-trailer-btn.png')}}" alt="">
                                    </div>
                                    <span>Assistir ao trailer</span>
                                </a>

                                <a id="see-more">
                                    <span>Ver mais</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="suggestions">
                    <span class="maybeyoulike">Talvez você goste</span>

                    <div class="genres">
                        @foreach($generos as $genero)
                            <div class="genre" data-id="{{ $genero->id }}">
                                <span>{{ $genero->nome }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="movies"></div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/filtro-filmes.js') }}"></script>
    <script src="{{ asset('js/perfil-menu.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/filme.css') }}">
</head>
<body>
    <div id="filme">
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
                <a href="{{ route('filmes') }}">Voltar</a>
                
                <div class="movie">
                    <div class="movie-poster">
                        <img src="{{ asset('storage/' . $filme->capa) }}" alt="">
                    </div>

                    <div class="movie-info-container">
                        <span class="movie-title">{{ $filme->nome }} ({{ $filme->ano_lancamento }})</span>

                        <div class="movie-info">
                            <div class="main-info">
                                <div class="movie-genres">
                                    @foreach ($filme->generos as $genero)
                                        <div class="movie-genre">
                                            <span>{{ $genero->nome }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <span class="movie-director">
                                    Diretor: {{ $filme->diretor }}
                                </span>

                                <span class="movie-age-rating">
                                    Classificação Indicativa: {{ $filme->classificacao->nome }}
                                </span>

                                <span class="movie-sinopsis">
                                    {{ $filme->sinopse }}
                                </span>
                            </div>
                        </div>

                        <div class="movie-btns">
                            <button class="movie-btn" id="mark-viewed-btn">
                                <span>Marcar como assistido</span>
                            </button>

                            <button class="movie-btn" id="make-review-btn">
                                <span>Avaliar</span>
                            </button>

                            <a class="movie-btn" id="watch-trailer-btn" href="{{ $filme->trailer }}" target="_blank" style="text-decoration: none;">
                                <span>Assistir trailer</span>
                            </a>

                            <button class="movie-btn" id="add-to-list-btn">
                                <span>Adicionar à lista</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active">
                        <span class="tab-name">Avaliações</span>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="reviews">
                        @foreach ($filme->avaliacoes as $avaliacao)
                            <div class="review">
                                <div class="review-header">
                                    <div class="review-user">
                                        <div class="user-img"></div>

                                        <span class="user-name">{{ $avaliacao->usuario->nome }}</span>
                                    </div>

                                <span class="date">Há 10h</span>
                                </div>
                            
                                <div class="review-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="star {{ $i <= $avaliacao->nota ? 'active' : '' }}">
                                            <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                        </div>
                                    @endfor
                                </div>

                                @if ($avaliacao->comentario)
                                    <span class="review-text">
                                        {{ $avaliacao->comentario }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="add-list-modal-fade" class="hidden">
        <div id="add-list-modal">
            <div class="modal-header">
                <span class="modal-header-text">
                    Salvar filme em
                </span>

                <div class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </div>
            </div>

            <div class="modal-content">
                <input type="checkbox" id="add-list-1" class="modal-content-checkbox">

                <label for="add-list-1">
                    <div class="modal-content-add">
                        <img src="{{ asset('imgs/check.png') }}" alt="">
                    </div>

                    <span class="list-name">A volta dos que não foram</span>
                </label> 
            </div>
        </div>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
</body>
</html>
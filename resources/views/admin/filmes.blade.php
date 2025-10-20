<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/filmes.css') }}">
</head>
<body>
    <div id="filme">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{ route('dashboard.index')}} ">
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
                    <a href="{{ route('dashboard.usuarios') }}">
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
        </aside>

        <main id="app" data-usuario-id="{{ Auth::user()->id }}" data-check-img-url="{{ asset('imgs/check.png') }}">
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

                        <a href="{{ route('filmes') }}">Usuário</a>   

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
                <div class="list">
                    <div class="list-header">
                        <span class="content-title">Lista de filmes</span>
                    </div>
                </div>

                <div class="movies-list">
                    <div class="movies-list-header">
                        <div class="movies-header-col">
                            <span>
                                Nome
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Diretor
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Lançamento
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Sinopse
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Classificação
                            </span>
                        </div>
                        
                        <div class="movies-header-col">
                            <span>
                                Trailer
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Ações
                            </span>
                        </div>
                    </div>

                    <div class="movies-list-rows">
                        <div class="movies-list-row">
                            <div class="movies-list-col">
                                <div class="movie-img">

                                </div>

                                <span>
                                    Ações
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <span>
                                    Ações
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <span>
                                    Ações
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <span>
                                    Ações
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <span>
                                    Ações
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <span>
                                    <a href="" class="trailer-link">
                                        Ver
                                    </a>
                                </span>
                            </div>

                            <div class="movies-list-col">
                                <button class="action-btn"></button>

                                <button class="action-btn"></button>

                                <button class="action-btn"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="movie-modal-fade">
        <div id="movie-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Editar filme
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="modal-body">
                @csrf

                <div class="form-movie-img">
                    <div class="img-preview">
                        <label for="change-img-btn" class="change-img">
                            <img src="{{ asset('imgs/camera.png') }}" alt="">
                        </label>
                    </div>

                    <input type="file" id="change-img-btn" style="display: none;" accept="image/*" name="fotoPerfil">
                </div>

                <div class="form-group">
                    <label for="form-nome">Nome</label>

                    <input type="text" id="form-nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="form-email">Diretor</label>

                    <input type="text" id="form-diretor" name="diretor" required>
                </div>

                <div class="form-group">
                    <label for="form-ano">Lançamento</label>

                    <input type="number" id="form-ano" name="diretor" required>
                </div>

                <div class="form-group">
                    <label>Classificação</label>

                    <div class="selected-option">
                        <span>
                            Livre
                        </span>
                    </div>

                    <div class="dropdown-menu hidden">
                        @foreach($classificacoes as $classificacao)
                            <button class="dropdown-btn" type="button">
                                <span>
                                    {{ $classificacao->nome }}
                                </span>
                            </button>
                        @endforeach
                   </div>
                </div>

                <div class="form-group">
                    <label>Gênero(s)</label>

                    <div class="chip-input">
                        @foreach($generos as $genero)
                            <button class="option" type="button">
                                <span>
                                    {{ $genero->nome }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Sinopse</label>

                    <textarea id="review-comment"></textarea>
                </div>

                <div class="form-group">
                    <label>Trailer</label>

                    <input type="text" id="form-diretor" name="diretor" required>
                </div>
            </form>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="delete-movie-btn">
                        <span>
                            Excluir filme
                        </span>
                    </button>

                    <div class="actions">
                        <button id="cancel-movie-btn">
                            <span>
                                Cancelar
                            </span>
                        </button>

                        <button id="save-movie-btn">
                            <span>
                                Salvar
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
</body>
</html>
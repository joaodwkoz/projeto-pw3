<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/filmes.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/dialog-modal.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/alert-dialog.css') }}">
</head>
<body>
    <div id="filmes" data-imgs-url="{{ url('imgs/') }}">
         <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{ route('dashboard.index')}} " >
                        <div class="icon">
                            <img src="{{ url('imgs/side-home.png')}}" alt="">
                        </div>

                        <span class="text">Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.filmes') }}" class="active">
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
                    <a href="{{ route('dashboard.generos') }}" >
                        <div class="icon">
                            <img src="{{ url('imgs/side-genres.png')}}" alt="">
                        </div>

                        <span class="text">Gêneros</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.avaliacoes') }}">
                        <div class="icon">
                            <img src="{{ url('imgs/side-reviews.png')}}" alt="">
                        </div>

                        <span class="text">Avaliações</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.listas') }}">
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

        <main id="app" data-usuario-id="{{ Auth::user()->id }}" data-check-img-url="{{ asset('imgs/check.png') }}" data-storage-url="{{ asset('storage/') }}">
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

                        <button id="movie-add-btn">
                            <span>
                                Adicionar filme
                            </span>
                        </button>
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
                                Status
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Ações
                            </span>
                        </div>
                    </div>

                    <div class="movies-list-rows">
                        @foreach($filmes as $filme)
                            <div class="movies-list-row" data-filme-id="{{ $filme->id }}">
                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->nome }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->diretor }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->ano_lancamento }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->classificacao->nome }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        <a href="{{ $filme->trailer }}" class="trailer-link" target="__blank">
                                            Ver
                                        </a>
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span class="status {{ $filme->status }}">
                                        {{ $filme->showStatusHTML() }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <button class="action-btn ver">
                                        <img src="{{ asset('imgs/ver.png') }}" alt="">
                                    </button>

                                    <button class="action-btn editar">
                                        <img src="{{ asset('imgs/editar.png') }}" alt="">
                                    </button>

                                    @if($filme->status == 'deletado')
                                        <button class="action-btn reativar">
                                            <img src="{{ asset('imgs/reativar.png') }}" alt="">
                                        </button>
                                    @else
                                        <button class="action-btn excluir">
                                            <img src="{{ asset('imgs/deletar.png') }}" alt="">
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="movie-modal-fade" class="hidden">
        <div id="movie-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Editar filme
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="modal-body" id="movie-form">
                @csrf

                <div class="form-movie-img">
                    <div class="img-preview">
                        <img src="{{''}}" alt="">

                        <label for="change-img-btn" class="change-img">
                            <img src="{{ asset('imgs/camera.png') }}" alt="">
                        </label>
                    </div>

                    <input type="file" id="change-img-btn" style="display: none;" accept="image/*" name="capa">
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

                    <input type="number" id="form-ano" name="ano_lancamento" required>
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
                            <button class="dropdown-btn" type="button" data-classificacao-id="{{ $classificacao->id }}">
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
                            <button class="option" type="button" data-genero-id="{{ $genero->id }}">
                                <span>
                                    {{ $genero->nome }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Sinopse</label>

                    <textarea name="sinopse"></textarea>
                </div>

                <div class="form-group">
                    <label>Trailer</label>

                    <input type="text" id="form-trailer" name="trailer" required>
                </div>
            </form>

            <div class="modal-footer">
                <div class="modal-btns">
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

    <div id="dialog-modal-fade" class="hidden">
        <div id="dialog-modal">
            <div class="modal-header">
                <img src="{{ url('imgs/modal-sucesso.png') }}" alt="">
            </div>

            <div class="modal-body">
                <span class="title">
                    Sucesso!
                </span>

                <span class="text">
                    Adicionado com sucesso!
                </span>

                <div class="info">
                    <span>
                        Mais informações:
                    </span>

                    <div class="box">
                        <span>
                            Erro ao salvar o nome
                        </span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="continue-dialog-btn">
                    <span>
                        Continuar
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div id="alert-modal-fade" class="hidden">
        <div id="alert-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Você tem certeza?                    
                </span>
            </div>

            <div class="modal-body">
                <span class="text">
                    Essa ocasionará no bloqueio do usuário de acessar a sua própria conta
                </span>
            </div>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="cancel-alert-btn">
                        <span>
                            Cancelar
                        </span>
                    </button>

                    <button id="continue-alert-btn">
                        <span>
                            Continuar
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components/dialog-modal.js') }}"></script>
    <script src="{{ asset('js/components/alert-dialog.js') }}"></script>
    <script src="{{ asset('js/perfil-menu.js') }}"></script>
    <script src="{{ asset('js/admin/filmes/dom-elements.js') }}"></script>
    <script src="{{ asset('js/admin/filmes/modals.js') }}"></script>
    <script src="{{ asset('js/admin/filmes/api.js') }}"></script>
    <script src="{{ asset('js/admin/filmes/events.js') }}"></script>
</body>
</html>
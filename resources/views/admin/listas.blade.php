<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/listas.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/dialog-modal.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/alert-dialog.css') }}">
</head>
<body>
    <div id="listas">
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
                            <img src="{{ url('imgs/side-users.png')}}" alt="">
                        </div>

                        <span class="text">Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.avaliacoes') }}">
                        <div class="icon">
                            <img src="{{ url('imgs/side-movies.png')}}" alt="">
                        </div>

                        <span class="text">Filmes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.avaliacoes') }}">
                        <div class="icon">
                            <img src="{{ url('imgs/side-genres.png')}}" alt="">
                        </div>

                        <span class="text">Gêneros</span>
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
                    <a href="" class="active">
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

        <main id="app" data-usuario-id="{{ Auth::user()->id }}" data-check-img-url="{{ asset('imgs/check.png') }}" data-storage-url="{{ asset('storage/') }}" data-imgs-url="{{ url('imgs/') }}">
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
                        <span class="content-title">Lista de listas</span>
                    </div>
                </div>

                <div class="lists-list">
                    <div class="lists-list-header">
                        <div class="lists-header-col">
                            <span>
                                Usuário
                            </span>
                        </div>

                        <div class="lists-header-col">
                            <span>
                                Nome
                            </span>
                        </div>

                        <div class="lists-header-col">
                            <span>
                                Filmes
                            </span>
                        </div>

                        <div class="lists-header-col">
                            <span>
                                Status
                            </span>
                        </div>

                        <div class="lists-header-col">
                            <span>
                                Ações
                            </span>
                        </div>
                    </div>

                    <div class="lists-list-rows">
                        @foreach($listas as $lista)
                            <div class="lists-list-row" data-lista-id="{{ $lista->id }}">
                                <div class="lists-list-col">
                                    <span>
                                        {{ $lista->usuario->nome }}
                                    </span>
                                </div>

                                <div class="lists-list-col">
                                    <span>
                                        {{ $lista->nome }}
                                    </span>
                                </div>

                                <div class="lists-list-col nota">
                                    <span>
                                        {{ $lista->filmes->count() }}
                                    </span>
                                </div>
                        
                                <div class="lists-list-col">
                                    <span class="status {{ $lista->status }}">
                                        {{ $lista->showStatusHTML() }}
                                    </span>
                                </div>

                                <div class="lists-list-col">
                                    <button class="action-btn ver">
                                        <img src="{{ asset('imgs/ver.png') }}" alt="">
                                    </button>

                                    @if($lista->status == 'deletado')
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

    <div id="list-modal-fade" class="hidden">
        <div id="list-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Ver lista
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <div class="modal-body" id="list-form">
                <div class="form-group">
                    <span class="label">
                        Usuário
                    </span>

                    <div class="data usuario">
                        <span>
                            
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <span class="label">
                        Nome
                    </span>

                    <div class="data nome">
                        <span>
                            
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <span class="label">
                        Descrição
                    </span>

                    <div class="data multiline descricao">
                        <span>

                        </span>
                    </div>
                </div>

                <div class="form-group filmes hidden">
                    <span>
                        Filmes (10)
                    </span>

                    <div class="movies-list">
                        @for($i = 1; $i <= 10; $i++)
                            <div class="movie">
                                <div class="marker"></div>

                                <div class="movie-poster">
                                    <img src="" alt="" style="display: none;">
                                </div>

                                <span class="movie-title">
                                    A volta dos que não foram
                                </span>
                            </div>
                        @endfor
                    </div>
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
    <script src="{{ asset('js/admin/listas/dom-elements.js') }}"></script>
    <script src="{{ asset('js/admin/listas/modals.js') }}"></script>
    <script src="{{ asset('js/admin/listas/api.js') }}"></script>
    <script src="{{ asset('js/admin/listas/events.js') }}"></script>
</body>
</html>
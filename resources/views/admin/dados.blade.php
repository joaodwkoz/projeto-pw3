<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/dados.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/dialog-modal.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/alert-dialog.css') }}">
</head>
<body>
    <div id="dados" data-imgs-url="{{ url('imgs/') }}">
         <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{ route('dashboard.index')}} " class="active">
                        <div class="icon">
                            <img src="{{ url('imgs/side-home.png')}}" alt="">
                        </div>

                        <span class="text">Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.filmes') }}">
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
                <span class="title">
                    Dados
                </span>

                <span class="subtitle">
                    Exporte relatórios e confira pdfs preparados com os armazenados para gerar insights.
                </span>

                <div class="data-group">
                    <span class="data-title">
                        Exportar relátorios (.csv)
                    </span>

                    <span class="data-subtitle">
                        Exporte tabelas inteiras com dados em forma de planilha .csv.
                    </span>

                    <div class="data-container">
                        <div class="data">
                            <span class="data-type">
                                Usuários (.csv)
                            </span>

                            <button class="download-btn" data-type="usuarios">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>

                        <div class="data">
                            <span class="data-type">
                                Filmes (.csv)
                            </span>

                            <button class="download-btn" data-type="filmes">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>

                        <div class="data">
                            <span class="data-type">
                                Avaliações (.csv)
                            </span>

                            <button class="download-btn" data-type="avaliacoes">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>

                        <div class="data">
                            <span class="data-type">
                                Listas (.csv)
                            </span>

                            <button class="download-btn" data-type="listas">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>

                        <div class="data">
                            <span class="data-type">
                                Gêneros (.csv)
                            </span>

                            <button class="download-btn" data-type="generos">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>

                        <div class="data">
                            <span class="data-type">
                                Contatos (.csv)
                            </span>

                            <button class="download-btn" data-type="contatos">
                                <span>
                                    Baixar
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
</head>
<body>
    <div id="home">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="" class="active">
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
                <div class="activity-feed">
                    <span>Atividades recentes</span>

                    <div class="activities">
                        <div class="activity">
                            <div class="activity-data">
                                <div class="user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">Assistiu o filme</span>
                                </div>

                                <span class="date">Há 1h</span>
                            </div>

                            <div class="activity-movie">
                                <div class="movie-img"></div>

                                <span class="movie-info">A morte dos esquecidos (2001)</span>
                            </div>
                        </div>

                        <div class="activity">
                            <div class="activity-data">
                                <div class="user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">Assistiu e avaliou o filme</span>
                                </div>

                                <span class="date">Há 1h</span>
                            </div>

                            <div class="activity-movie">
                                <div class="movie-img"></div>

                                <span class="movie-info">A morte dos esquecidos (2001)</span>
                            </div>

                            <div class="review">
                                <span class="review-text">Filme ótimo, assistiria mais de uma vez se necessário.</span>

                                <div class="rating">
                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>
                                    
                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>

                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>

                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>

                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="activity">
                            <div class="activity-data">
                                <div class="user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">Criou uma nova lista</span>
                                </div>

                                <span class="date">Há 1h</span>
                            </div>

                            <div class="activity-list">
                                <div class="list-img"></div>

                                <span class="list-info">Filmes de terror do século</span>
                            </div>
                        </div>

                        <div class="activity">
                            <div class="activity-data">
                                <div class="user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">Seguiu você</span>
                                </div>

                                <span class="date">Há 1h</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="movies-list">
                    <div class="movies-list-header">
                        <span>Filmes populares</span>

                        <div class="movies-list-btns">
                            <button>
                                <img src="{{ asset('imgs/icon-seta-esquerda.png') }}" alt="">
                            </button>

                            <button>
                                <img src="{{ asset('imgs/icon-seta-direita.png') }}" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="movies-scroll-list">
                        <div class="movie"></div>

                        <div class="movie"></div>

                        <div class="movie"></div>

                        <div class="movie"></div>

                        <div class="movie"></div>

                        <div class="movie"></div>
                    </div>
                </div>

                <div class="lists-list">
                    <div class="lists-list-header">
                        <span>Listas populares</span>

                        <div class="lists-list-btns">
                            <button>
                                <img src="{{ asset('imgs/icon-seta-esquerda.png') }}" alt="">
                            </button>

                            <button>
                                <img src="{{ asset('imgs/icon-seta-direita.png') }}" alt="">
                            </button>
                        </div>
                    </div>

                    <div class="lists-scroll-list">
                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <div class="list-creator-user">
                                    <div class="creator-img"></div>

                                    <span class="creator-name">João Pedro</span>
                                </div>
                            </div>
                        </div>

                        <div class="list">
                            <div class="list-info">
                                <span class="list-updated">Atualizada há 10d</span>
                            </div>

                            <div class="picture">
                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>

                                <div class="img"></div>
                            </div>

                            <span class="list-name">Favoritos</span>

                            <div class="list-quantity">
                                <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                                <span class="quantity">10</span>
                            </div>

                            <div class="list-creator">
                                <span class="list-created-by">Criada por</span>

                                <span class="creator-name">João Pedro</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
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

        <main id="app" data-api-url="{{ url('api/filmes/genero') }}" data-storage-url="{{ asset('storage') }}" data-filme-show-url-base="{{ url('filmes') }}/">
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
                <span class="content-title">Descubra por gênero</span>

                <div class="genres">
                    @foreach($generos as $genero)
                        <div class="genre" data-id="{{ $genero->id }}">
                            <span>{{ $genero->nome }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="movies-list">
                    <div class="movies-list-header">
                        <span class="movies-list-title">Filmes populares</span>

                        @if($filmesPopulares->count() > 5)
                            <div class="movies-list-btns">
                                <button>
                                    <img src="{{ asset('imgs/icon-seta-esquerda.png') }}" alt="">
                                </button>

                                <button>
                                    <img src="{{ asset('imgs/icon-seta-direita.png') }}" alt="">
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="movies-scroll-list">
                        @if($filmesPopulares->count() > 0)
                            @foreach($filmesPopulares as $popular)
                                <a class="movie" href="{{ route('filmes.show', ['filme' => $popular->id]) }}">
                                    <div class="movie-poster">
                                        <img src="{{ asset('storage/' . $popular->capa) }}" alt="">
                                    </div>

                                    <div class="movie-rating-badge">
                                        <span class="movie-rating-num">{{ round($popular->notaMedia) ?? 0 }}</span>

                                        <div class="movie-rating-stars">
                                            <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="movies-list">
                    <div class="movies-list-header">
                        <span class="movies-list-title">Recomendados por gênero</span>

                        @if($recomendadosPorGenero->count() > 5)
                            <div class="movies-list-btns">
                                <button>
                                    <img src="{{ asset('imgs/icon-seta-esquerda.png') }}" alt="">
                                </button>

                                <button>
                                    <img src="{{ asset('imgs/icon-seta-direita.png') }}" alt="">
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="movies-scroll-list recommended">
                        @if($recomendadosPorGenero->count() > 0)
                            @foreach($recomendadosPorGenero as $recomendado)
                                <a class="movie" href="{{ route('filmes.show', ['filme' => $recomendado->id]) }}">
                                    <div class="movie-poster">
                                        <img src="{{ asset('storage/' . $recomendado->capa) }}" alt="">
                                    </div>

                                    <div class="movie-rating-badge">
                                        <span class="movie-rating-num">{{ round($recomendado->notaMedia) ?? 0 }}</span>

                                        <div class="movie-rating-stars">
                                            <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="movies-list total">
                    <div class="movies-list-header">
                        <span class="movies-list-title">Todos os filmes</span>
                    </div>

                    <div class="movies-scroll-list vertical">
                        @if($filmes->count() > 0)
                            @foreach($filmes as $filme)
                                <a class="movie" href="{{ route('filmes.show', ['filme' => $filme->id]) }}">
                                    <div class="movie-poster">
                                        <img src="{{ asset('storage/' . $filme->capa) }}" alt="">
                                    </div>

                                    <div class="movie-rating-badge">
                                        <span class="movie-rating-num">{{ round($filme->notaMedia) ?? 0 }}</span>

                                        <div class="movie-rating-stars">
                                            <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>

                    @if($filmes->count() > 0)
                        <div class="paginate-btns">
                            @for($i = 1; $i <= $filmes->lastPage(); $i++)
                                <div class="paginate-btn {{ $i == 1 ? 'active' : '' }}" data-page="{{ $i }}">
                                    <span class="paginate-counter">
                                        {{ $i }}
                                    </span>
                                </div>
                            @endfor
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const storageUrl = document.querySelector('main').dataset.storageUrl;
            const filmesShowUrlBase = document.querySelector('main').dataset.filmeShowUrlBase;

            const filmesGrid = document.querySelector('.movies-scroll-list.vertical');
            const paginateBtnsContainer = document.querySelector('.paginate-btns');

            fetchMovies(1);

            function renderPaginationButtons(lastPage, currentPage) {
                if (!paginateBtnsContainer) return;
    
                paginateBtnsContainer.innerHTML = ''; 

                for (let i = 1; i <= lastPage; i++) {
                    const btn = document.createElement('div');

                    btn.className = 'paginate-btn';

                    if (i === currentPage) {
                        btn.classList.add('active');
                    }

                    btn.dataset.page = i;

                    const span = document.createElement('span');
                    span.className = 'paginate-counter';
                    span.textContent = i;
                    btn.appendChild(span);
                    
                    btn.addEventListener('click', function() {
                        const pageNumber = this.dataset.page;
                        fetchMovies(pageNumber); 
                    });

                    paginateBtnsContainer.appendChild(btn);
                }
            }

            function renderMovies(filmes) {
                filmesGrid.innerHTML = ''; 
                
                filmes.forEach(filme => {
                    filmesGrid.appendChild(createMovieCard(filme)); 
                });
            }

            function createMovieCard(filme) {
                const movie = document.createElement('a');
                movie.className = 'movie';
                movie.href = `${filmesShowUrlBase}${filme.id}`;

                movie.innerHTML = `
                    <div class="movie-poster">
                        <img src="${storageUrl}/${filme.capa}" alt="${filme.nome}">
                    </div>
                    <div class="movie-rating-badge">
                        <span class="movie-rating-num">${Math.round(filme.avaliacoes_avg_nota) || 0}</span>
                        <div class="movie-rating-stars">
                            <img src="/imgs/side-reviews.png" alt="">
                        </div>
                    </div>
                `;

                return movie;
            }

            async function fetchMovies(page = 1) {
                const apiUrl = '../api/filmes/';

                const url = new URL(apiUrl, window.location.origin);
                url.searchParams.append('page', page);

                try {
                    const response = await fetch(url);

                    if (!response.ok) throw new Error('Falha ao carregar filmes.');
                    
                    const data = await response.json();
                
                    renderMovies(data.data);
                    
                    renderPaginationButtons(data.last_page, data.current_page);
                
                } catch (e) {
                    console.error('Erro ao buscar filmes:', e);
                    alert('Erro ao buscar filmes:', e);
                }
            }
        });
    </script>
    <script src="{{ asset('js/filtro-filmes.js') }}"></script>
</body>
</html>
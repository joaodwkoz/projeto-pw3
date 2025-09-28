<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="dashboard">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-home.png')}}" alt="">
                        </div>

                        <span class="text">Home</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-movies.png')}}" alt="">
                        </div>

                        <span class="text">Filmes</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-lists.png')}}" alt="">
                        </div>

                        <span class="text">Listas</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.contatos')}}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-users.png')}}" alt="">
                        </div>

                        <span class="text">Perfil</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.contatos') }}">
                        <div class="icon">
                            <img src="{{ asset('imgs/side-settings.png')}}" alt="">
                        </div>

                        <span class="text">Configurações</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main id="app" data-api-url="{{ url('api/filmes/genero') }}" data-storage-url="{{ asset('storage') }}">
           <header>
                <div class="search-bar">

                </div>

                <div class="profile-container">
                    <button class="notifications"></button>

                    <div class="profile"></div>
                </div>
           </header>

            <div class="content">
                <div class="popular">
                    <div class="img">
                        <img src="{{ asset('storage/' . $filmePopular->banner) }}" alt="">
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

                <div class="suggestions">
                    <span class="maybeyoulike">Talvez você goste</span>

                    <div class="genres">
                        @foreach($generos as $genero)
                            <div class="genre" data-id="{{ $genero->id }}">
                                <span>{{ $genero->nome }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="movies">

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/filtro-filmes.js"></script>
</body>
</html>
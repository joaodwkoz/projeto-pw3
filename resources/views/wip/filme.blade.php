<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="{{ url('css/filme.css') }}" rel="stylesheet">
</head>
<body id="home">
    <main id="app">
        <aside id="sidebar">
            <div id="logo">

            </div>

            <div id="list">
                <ul>
                    <li>
                        <a href="" class="option">
                            <div class="icon"></div>

                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="" class="option">
                            <div class="icon"></div>

                            <span>Em cartaz</span>
                        </a>
                    </li>

                    <li>
                        <a href="" class="option">
                            <div class="icon"></div>

                            <span>Favoritos</span>
                        </a>
                    </li>

                    <li>
                        <a href="" class="option">
                            <div class="icon"></div>

                            <span>Suporte</span>
                        </a>
                    </li>

                    <li>
                        <a href="" class="option">
                            <div class="icon"></div>

                            <span>Configurações</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        
        <div class="main-container">
            <div class="top">
                <input type="text" class="pesquisa" placeHolder="Pesquisar">
            </div>
           

           <div class="bottom">
                <h1 class="tituloFilme">Formula 1: O filme</h1>
                <p class="resumo"> Na década de 1990, Sonny Hayes era o piloto mais promissor da Fórmula 1 até que um acidente na pista quase encerrou sua carreira. Trinta anos depois, o proprietário de uma equipe de Fórmula 1 em dificuldades convence Sonny a voltar a correr e se tornar o melhor do mundo.</p>
                
                <div class="grupoGenero">
                    <div class="genero">ação</div>
                    <div class="genero">drama</div>
                    <div class="genero">aventura</div>
                </div>

                <div class="grupoBtn">
                    <a class="btn" id="trailer">Trailer <img id="play" src="{{url('../img/play_movie.png')}}" alt=""></a>
                    <a class="btn" id="favorito"><img id="save" src="{{url('../img/save_movie.png')}}" alt=""></a>
                    <a class="btn" id="lista"><img id="add" src="{{url('../img/addLista_movie.png')}}" alt=""> </a>
                    <a class="btn" id="jaVi"></a>
                </div>

           </div>

          


        </div>
    </main>
</body>
</html>
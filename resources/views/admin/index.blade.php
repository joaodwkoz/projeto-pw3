<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/dashboard.css') }}">


</head>
<body>
    <div id="dashboard">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{route('dashboard.index')}}">
                        <div class="icon">
                            <img src="imgs/side-home.png" alt="">
                        </div>

                        <span class="text">Home</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="imgs/side-movies.png" alt="">
                        </div>

                        <span class="text">Filmes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.usuarios') }}">
                        <div class="icon">
                            <img src="imgs/side-users.png" alt="">
                        </div>

                        <span class="text">Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="imgs/side-reviews.png" alt="">
                        </div>

                        <span class="text">Avaliações</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <div class="icon">
                            <img src="imgs/side-lists.png" alt="">
                        </div>

                        <span class="text">Listas</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard.contatos')}}">
                        <div class="icon">
                            <img src="imgs/side-contacts.png" alt="">
                        </div>

                        <span class="text">Contatos</span>
                    </a>
                </li>
            </ul>

            <div class="profile-content">
                <div class="profile">
                    <div class="profile-icon"></div>

                    <span class="profile-name">
                        {{ auth()->user()->nome }}
                    </span>
                </div>

                <a href="" class="log-out" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <div class="icon">
                        <img src="{{ asset('imgs/side-logout.png') }}" alt="">
                    </div>

                    <span class="text">Sair</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        
        <main id="app">
            <span class="title">Dashboard</span>

            <div id="stats">
                <div class="cards">
                    <div class="card movies">
                        <div class="icon">
                            <img src="imgs/icon-filme.png" alt="">
                        </div>

                        <div class="text">
                            <span class="card-title">Total de filmes</span>

                            <span class="card-qtd">150</span>
                        </div>
                    </div>

                    <div class="card users">
                        <div class="icon">
                            <img src="imgs/icon-usuario.png" alt="">
                        </div>

                        <div class="text">
                            <span class="card-title">Total de usuários</span>

                            <span class="card-qtd">32</span>
                        </div>
                    </div>

                    <div class="card reviews">
                        <div class="icon">
                            <img src="imgs/icon-reviews.png" alt="">
                        </div>

                        <div class="text">
                            <span class="card-title">Total de avaliações</span>

                            <span class="card-qtd">12</span>
                        </div>
                    </div>

                    <div class="card watched-movies">
                        <div class="icon">
                            <img src="imgs/icon-olho.png" alt="">
                        </div>

                        <div class="text">
                            <span class="card-title">Filmes assistidos</span>

                            <span class="card-qtd">247</span>
                        </div>
                    </div>
                </div>

                <div class="charts">
                    <div class="chart">
                        <div class="chart-header">
                            <div class="chart-icon">
                                <img src="imgs/icon-grafico.png" alt="">
                            </div>

                            <span class="chart-title">Usuários mais interativos</span>
                        </div>
                         <div id="campos" >
                            @foreach($topUsers as $usuario)
                            <div class="campo user">
                                <div class="barra"></div>
                                <div class="circleImg">
                                    <img src="imgs/icon-usuario.png" alt="" class="img user">
                                </div>
                                <div class="campoTxt">
                                    <p class="txt user">{{$usuario -> nome}}</p>
                                    <p class="txt user">{{$usuario -> filmes_assistidos_count}}</p>
                                </div>
                            </div>
                            @endforeach
                         </div>
                    </div>

                    <div class="chart">
                        <div class="chart-header">
                            <div class="chart-icon">
                                <img src="imgs/icon-grafico.png" alt="">
                            </div>

                            <span class="chart-title">Filmes em alta</span>
                        </div>
                            <div id="campos" >
                            @foreach($topMovies as $movie)
                            <div class="campo filme">
                                <div class="barra"></div>
                                <div class="circleImg">
                                    <img src="imgs/icon-usuario.png" alt="" class="img filme">
                                </div>
                                <div class="campoTxt">
                                    <p class="txt filme">{{$movie -> nome}}</p>
                                    <p class="txt filme">{{$movie -> avaliacoes_count}}</p>
                                </div>
                            </div>
                            @endforeach
                         </div>

                    </div>

                    <div class="chart">
                        <div class="chart-header">
                            <div class="chart-icon">
                                <img src="imgs/icone-trofeu.png" alt="">
                            </div>

                            <span class="chart-title">Genêros mais populares</span>
                        </div>

                        <div class="grafico">
                              <canvas id="myChart"></canvas>
                              <div class="txtGrafico">
                                <div class="genero">
                                    <p class="txtGenero">comedia</p>
                                    <p class="txtGenero">20</p>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="log">
                <span class="title">Atividades recentes</span>

                <div class="table">
                    <div class="header">
                        <div class="col" style="width: 128px;">
                            <span>ID Atividade</span>
                        </div>

                        <div class="col" style="width: 188px;">
                            <span>Nome de usuário</span>
                        </div>

                        <div class="col" style="width: 128px;">
                            <span>Ação</span>
                        </div>

                        <div class="col" style="width: 176px;">
                            <span>Descrição</span>
                        </div>

                        <div class="col" style="width: 128px;">
                            <span>ID Filme</span>
                        </div>

                        <div class="col" style="width: 200px;">
                            <span>Filme</span>
                        </div>

                        <div class="col" style="width: 176px;">
                            <span>Data</span>
                        </div>
                    </div>

                    <div class="rows">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
            datasets: [{
        label: '',
        data: [12, 19, 3, 5, 2],
        backgroundColor: ['#5D6BFF', '#68E05D', '#DF543A', '#F07020', '#FEB01F'],
        borderWidth: 0,
        spacing:0,
      }]
    },
    options: {
    responsive: false,
    cutout: '80%',
    }
  });
</script>

</body>
</html>
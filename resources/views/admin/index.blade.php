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
                                <a class="labelVer">Ver mais</a>
                            </div>
                            <div class="grafico">
                                    <div class="Chart">
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    <div id="legendaGenero"></div>
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
document.addEventListener('DOMContentLoaded', function () {
  try {
    const topGenres = @json($topGenres) || [];   
    let allGenres = @json($allGenres) || [];
        allGenres = [...allGenres].sort((a, b) => {
            const va = Number(a.total_assistido ?? 0);
            const vb = Number(b.total_assistido ?? 0);
            return vb - va; 
    });
    const colors = [
      '#5D6BFF', '#68E05D', '#DF543A', '#F07020', '#FEB01F',
      '#D46BFF', '#36C3FF', '#FF6BA6', '#00BFA6', '#A8A8A8'
    ];

    const getName = g => (g && (g.nome ?? g['nome'] ?? g.name ?? g['name'])) ?? '—';
    const getValue = g => (g && (g.total_assistido ?? g['total_assistido'] ?? g.value ?? g['value'])) ?? 0;

    const canvas = document.getElementById('myChart');
    if (canvas && Array.isArray(topGenres) && topGenres.length > 0) {
      const ctx = canvas.getContext('2d');

      const labels = topGenres.map(g => getName(g));
      const data = topGenres.map(g => Number(getValue(g)));
      const bg = labels.map((_, i) => colors[i % colors.length]);

      if (canvas._chartInstance) canvas._chartInstance.destroy();

      canvas._chartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels,
          datasets: [{ data, backgroundColor: bg, borderWidth: 0 }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '80%',
          plugins: { legend: { display: false } }
        }
      });

      const legendaContainer = document.getElementById('legendaGenero');
      if (legendaContainer) {
        legendaContainer.innerHTML = '';
        topGenres.forEach((g, i) => {
          const cor = bg[i];
          const item = document.createElement('div');
          item.className = 'legenda-item';
          item.dataset.color = cor;
          item.innerHTML = `
            <div class="legenda-cor" style="background-color: ${cor}"></div>
            <span class="legenda-nome" style="color: ${cor}">${getName(g)}</span>
            <span class="legenda-valor" style="color: ${cor}">${getValue(g)}</span>
          `;
          legendaContainer.appendChild(item);
        });
      }
    }

    const btnVerMais = document.querySelector('.labelVer');
    const modal = document.getElementById('modalGeneros');
    const closeBtn = document.querySelector('.close-lista') || document.querySelector('.close-generos');

    if (btnVerMais && modal) {
      btnVerMais.addEventListener('click', () => { modal.style.display = 'flex'; });
    }
    if (closeBtn && modal) {
      closeBtn.addEventListener('click', () => { modal.style.display = 'none'; });
    }
    if (modal) {
      modal.addEventListener('click', (e) => { if (e.target === modal) modal.style.display = 'none'; });
    }

    const modalLista = document.getElementById('listaGenerosModal');

    if (modalLista) {
      const renderedItems = modalLista.querySelectorAll('.item-genero');

      if (renderedItems.length === allGenres.length && renderedItems.length > 0) {
        renderedItems.forEach((item, i) => {
          const cor = colors[i % colors.length];
          const barra = item.querySelector('.item-barra') || item.querySelector('.barra') || null;
          const nomeEl = item.querySelector('.genero-nome');
          const valEl = item.querySelector('.genero-valor');

          if (barra) barra.style.backgroundColor = cor;
          if (nomeEl) nomeEl.style.color = cor;
          if (valEl) valEl.style.color = cor;

          if (nomeEl) nomeEl.textContent = getName(allGenres[i]);
          if (valEl) valEl.textContent = getValue(allGenres[i]);
        });
      } else {
        modalLista.innerHTML = '';
        allGenres.forEach((g, i) => {
          const cor = colors[i % colors.length];
          const wrapper = document.createElement('div');
          wrapper.className = 'item-genero';
          wrapper.dataset.index = String(i);
          wrapper.innerHTML = `
            <div class="item-left">
              <div class="item-barra" style="background-color:${cor}"></div>
              <span class="genero-nome" style="color:${cor}">${getName(g)}</span>
            </div>
            <span class="genero-valor" style="color:${cor}">${getValue(g)}</span>
          `;
          modalLista.appendChild(wrapper);
        });
      }
    } 

  } catch (err) {
    console.error('Erro ao inicializar chart/modal de gêneros:', err);
  }
});
</script>



    <div id="modalGeneros" class="modal-lista">
        <div class="lista-content">
            
            <div class="lista-header">
                <h2>Gêneros</h2>
                <span class="close-lista">&times;</span>
            </div>

            <div class="lista-generos" id="listaGenerosModal">
                @foreach($allGenres as $index => $g)
                <div class="item-genero" data-index="{{ $index }}">
                    <div class="item-left">
                        <div class="item-barra"></div>
                        <span class="genero-nome">{{ $g->nome }}</span>
                    </div>

                    <span class="genero-valor">{{ $g->total_assistido }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>




    </body>
    </html>
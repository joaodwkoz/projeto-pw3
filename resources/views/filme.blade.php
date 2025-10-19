<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/filme.css') }}">
</head>
<body>
    <div id="filme">
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

        <main id="app" data-usuario-id="{{ Auth::user()->id }}" data-check-img-url="{{ asset('imgs/check.png') }}" data-filme-id="{{ $filme->id }}" data-usuario-nome="{{ Auth::user()->nome }}" data-star-img-url="{{ asset('imgs/side-reviews.png') }}">
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
                <a href="{{ route('filmes') }}">Voltar</a>
                
                <div class="movie">
                    <div class="movie-poster">
                        <img src="{{ asset('storage/' . $filme->capa) }}" alt="">
                    </div>

                    <div class="movie-info-container">
                        <span class="movie-title">{{ $filme->nome }} ({{ $filme->ano_lancamento }})</span>

                        <div class="movie-info">
                            <div class="main-info">
                                <div class="movie-genres">
                                    @foreach ($filme->generos as $genero)
                                        <div class="movie-genre">
                                            <span>{{ $genero->nome }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <span class="movie-director">
                                    Diretor: {{ $filme->diretor }}
                                </span>

                                <span class="movie-age-rating">
                                    Classificação Indicativa: {{ $filme->classificacao->nome }}
                                </span>

                                <span class="movie-sinopsis">
                                    {{ $filme->sinopse }}
                                </span>
                            </div>
                        </div>

                        <div class="movie-btns">
                            <button class="movie-btn" id="mark-viewed-btn" data-assistido="{{ $assistido ? 'true' : 'false' }}">
                                <span>{{ $assistido ? 'Desmarcar como assistido' : 'Marcar como assistido' }}</span>
                            </button>

                            <button class="movie-btn" id="make-review-btn">
                                <span>Avaliar</span>
                            </button>

                            <a class="movie-btn" id="watch-trailer-btn" href="{{ $filme->trailer }}" target="_blank" style="text-decoration: none;">
                                <span>Assistir trailer</span>
                            </a>

                            <button class="movie-btn" id="add-to-list-btn" >
                                <span>Adicionar à lista</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab active">
                        <span class="tab-name">Avaliações</span>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="reviews">
                        @foreach ($filme->avaliacoes as $avaliacao)
                            <div class="review">
                                <div class="review-header">
                                    <div class="review-user">
                                        <div class="user-img"></div>

                                        <span class="user-name">{{ $avaliacao->usuario->nome }}</span>
                                    </div>

                                <span class="date">
                                    {{ $avaliacao->getTempoDesde() }}
                                </span>
                                </div>
                            
                                <div class="review-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div class="star {{ $i <= $avaliacao->nota ? 'active' : '' }}">
                                            <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                        </div>
                                    @endfor
                                </div>

                                @if ($avaliacao->comentario)
                                    <span class="review-text">
                                        {{ $avaliacao->comentario }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="add-list-modal-fade" class="hidden">
        <div id="add-list-modal">
            <div class="modal-header">
                <span class="modal-header-text">
                    Salvar filme em
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <div class="modal-content">
    
            </div>
        </div>
    </div>

    <div id="review-modal-fade" class="hidden">
        <div id="review-modal">
            <div class="modal-header">
                <span class="modal-header-text">
                    Fazer avaliação
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <div class="modal-content">
                <div class="modal-content-rating">
                    <div class="star">
                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="" >
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

                <textarea placeholder="Escreva sua avaliação aqui" id="review-comment"></textarea>

                <div class="btns">
                    <button id="cancel-review-btn" style="background: transparent; border: 0.25vw solid rgba(255, 255, 255, 0.5)">
                        <span style="color: rgba(255, 255, 255, 0.5)">
                            Cancelar
                        </span>
                    </button>

                    <button id="save-review-btn">
                        <span>
                            Salvar
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const usuarioId = Number(document.querySelector('main').dataset.usuarioId);

            const addListBtn = document.querySelector('#add-to-list-btn');
            const addListModal = document.querySelector('#add-list-modal-fade');
            const addListModalContent = addListModal.querySelector('.modal-content');
            const addListModalClose = addListModal.querySelector('.modal-header-close');

            addListModal.addEventListener('click', (e) => {
                if (e.target === addListModal) {
                    fecharModalLista();
                }
            });

            const abrirModalLista = () => {
                addListModal.classList.remove('hidden');
            }

            const fecharModalLista = () => {
                addListModalContent.innerHTML = "";
                addListModal.classList.add('hidden');
            }

            addListModalClose.addEventListener('click', fecharModalLista);

            const filmeId = Number(document.querySelector('main').dataset.filmeId);

            addListBtn.addEventListener('click', () => {
                addListModalContent.innerHTML = "";
                fetchListasUsuario();
                abrirModalLista();
            });

            const markAsViewedBtn = document.querySelector('#mark-viewed-btn');

            markAsViewedBtn.addEventListener('click', () => {
                if (markAsViewedBtn.dataset.assistido === 'true') {
                    desmarcarComoAssistido();
                } else {
                    marcarComoAssistido();
                }
            });

            async function marcarComoAssistido() {
                const url = "../api/filmes/" + filmeId + "/marcar-como-assistido";

                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({usuario_id: usuarioId})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Marcado como assistido!');
                        markAsViewedBtn.querySelector('span').textContent = 'Desmarcar como assistido';
                        markAsViewedBtn.dataset.assistido = 'true';
                    } else {
                        alert(data.message + "!");
                    }
                });
            }

            async function desmarcarComoAssistido() {
                const url = "../api/filmes/" + filmeId + "/desmarcar-como-assistido";

                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({usuario_id: usuarioId})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Desmarcado como assistido!');
                        markAsViewedBtn.querySelector('span').textContent = 'Marcar como assistido';
                        markAsViewedBtn.dataset.assistido = 'false';
                    } else {
                        alert(data.message + "!");
                    }
                });
            }

            async function fetchListasUsuario() {
                const url = "../api/usuario/" + usuarioId + "/listas/" + filmeId;

                await fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        let i = 1;

                        for (const lista of data) {
                            const input = document.createElement('input');
                            input.setAttribute('type', 'checkbox');
                            input.setAttribute('id', `add-list-${i}`);
                            input.className = 'modal-content-checkbox';

                            if (lista.is_checked) {
                                input.setAttribute('checked', 'checked'); 
                            }

                            const currentInput = input;

                            currentInput.addEventListener('change', () => {
                                const isChecked = currentInput.checked;

                                if (isChecked) {
                                    adicionarFilmeLista(lista.id);
                                } else {
                                    removerFilmeLista(lista.id);
                                }
                            });

                            addListModalContent.appendChild(currentInput);
                            addListModalContent.appendChild(createListaRow(lista, i));

                            i++;
                        }
                    } else {
                        alert('Nenhuma lista criada. Crie uma para conseguir adicionar seus filmes preferidos!');
                    }
                });
            }

            async function adicionarFilmeLista(listaId) {
                const url = "../api/listas/" + listaId + "/filme";

                await fetch(url, {
                    method: 'POST',
                    headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({'filme_id': filmeId})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Filme adicionado à lista com sucesso!');
                    }
                });
            }

            async function removerFilmeLista(listaId) {
                const url = "../api/listas/" + listaId + "/filme";

                await fetch(url, {
                    method: 'DELETE',
                    headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({'filme_id': filmeId})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Filme removido da lista com sucesso!');
                    }
                });
            }

            function createListaRow(lista, id) {
                const label = document.createElement('label');
                label.setAttribute('for', `add-list-${id}`);

                const div = document.createElement('div');
                div.className = 'modal-content-add';

                const img = document.createElement('img');
                img.src = document.querySelector('main').dataset.checkImgUrl;

                div.appendChild(img);

                label.appendChild(div);

                const span = document.createElement('span');
                span.className = 'list-name';
                span.textContent = lista.nome;

                label.appendChild(span);

                return label;
            }

            const reviewModal = document.querySelector('#review-modal-fade');

            const abrirModalAvaliacao = () => {
                reviewModal.classList.remove('hidden');
            }

            const makeReviewBtn = document.querySelector('#make-review-btn');
            makeReviewBtn.addEventListener('click', abrirModalAvaliacao);

            const stars = reviewModal.querySelectorAll('.star');
            let currentNota = 0;

            stars.forEach((starElement, index) => {
                starElement.addEventListener('click', () => {
                    const clickedIndex = index;
                    currentNota = index + 1;
                    stars.forEach((star, i) => {
                        if (i <= clickedIndex) {
                            star.classList.add('active');
                        } else {
                            star.classList.remove('active');
                        }
                    });
                });
            });

            const saveReviewBtn = reviewModal.querySelector('#save-review-btn');

            const cancelReviewBtn = reviewModal.querySelector('#cancel-review-btn');

            saveReviewBtn.addEventListener('click', () => {
                makeReview();
            });

            const fecharModalAvaliacao = () => {
                reviewModal.classList.add('hidden');

                document.querySelector('#review-comment').value = "";
                stars.forEach((starElement, index) => {
                    starElement.classList.remove('active');
                });
            }

            cancelReviewBtn.addEventListener('click', fecharModalAvaliacao);

            const reviews = document.querySelector('.reviews');

            function createReviewElement(nome, comentario, nota) {
                const createRatingHtml = (nota) => {
                    let starsHtml = '';
                    const fullStars = Math.floor(nota);

                    for (let i = 1; i <= 5; i++) {
                        const isActive = i <= fullStars ? 'active' : '';
        
                        starsHtml += `
                            <div class="star ${isActive}">
                                <img src="${document.querySelector('main').dataset.starImgUrl}" alt="">
                            </div>
                        `;
                    }
                    return starsHtml;
                };

                const reviewDiv = document.createElement('div');
                reviewDiv.className = 'review';
                
                reviewDiv.innerHTML = `
                    <div class="review-header">
                        <div class="review-user">
                            <div class="user-img"></div>
                            
                            <span class="user-name">${nome || 'Usuário'}</span> 
                        </div>
                        
                        <span class="date">Agora mesmo</span>
                    </div>
                    
                    <div class="review-rating">
                        ${createRatingHtml(nota || 0)}
                    </div>
                    
                    ${comentario ? 
                        `<span class="review-text">${comentario}</span>` 
                        : ''}
                `;

                return reviewDiv;
            }

            async function makeReview() {
                const url = "../api/avaliacoes/";

                const comentario = reviewModal.querySelector('#review-comment').value;

                await fetch(url, {
                    method: 'POST',
                    headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({'usuario_id': usuarioId, 'filme_id': filmeId, 'nota': currentNota, 'comentario': comentario})
                })
                .then(res => res.json())
                .then(data => {
                    if (data.sucesso) {
                        alert('Avaliação feita com sucesso!');
                    }
                })
                .finally(() => {
                    fecharModalAvaliacao();
                    reviews.appendChild(createReviewElement(document.querySelector('main').dataset.usuarioNome, comentario, currentNota));
                });
            }
        });
    </script>
</body>
</html>
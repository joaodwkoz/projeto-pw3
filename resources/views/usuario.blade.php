<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/usuario.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="perfil">
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
                    <a href="#" class="{{ auth()->user()->id == $usuario->id ? 'active' : '' }}">
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

        <main id="app" data-api-url="{{ url('api/filmes/genero') }}" data-storage-url="{{ asset('storage') }}" data-usuario-id="{{ $usuario->id }}" data-usuario-nome="{{ $usuario->nome }}" data-usuario-email="{{ $usuario->email }}">
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
                        <span>{{ auth()->user()->nome }}</span>
                    </button>

                    <div class="profile-menu hidden">
                        <a href="{{ route('perfil') }}">Ver perfil</a>

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
                <div class="user-profile">
                    <div class="user">
                        <div class="user-img">
                            <img src="{{ $usuario->fotoPerfil ? 'storage/' .  $usuario->fotoPerfil : '' }}" alt="" style="display: {{ $usuario->fotoPerfil ? 'block' : 'none' }}">
                        </div>

                        <span class="user-name">{{ $usuario->nome }}</span>
                    </div>

                    <div class="user-btns">
                        @if(auth()->user()->id == $usuario->id ? 'active' : '' )
                            <button id="delete-profile-btn">
                                <span>
                                    Excluir perfil
                                </span>
                            </button>

                            <button id="edit-profile-btn">
                                <span>
                                    Editar perfil
                                </span>
                            </button>
                        @endif   
                    </div>
                </div>

                <div class="tabs">
                    <div class="tab" data-target-tab="actitivies">
                        <span class="tab-name">
                            Atividades
                        </span>
                    </div>

                    <div class="tab active" data-target-tab="watched-movies">
                        <span class="tab-name">
                            Filmes assistidos
                        </span>
                    </div>

                    <div class="tab" data-target-tab="reviews">
                        <span class="tab-name">
                            Avaliação
                        </span>
                    </div>

                    <div class="tab" data-target-tab="lists">
                        <span class="tab-name">
                            Listas
                        </span>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="activities hidden">
                        <div class="activity">
                            <div class="activity-data">
                                <div class="activity-user">
                                    <div class="user-img"></div>

                                    <span class="user-name">João Pedro</span>

                                    <span class="action">assistiu o filme</span>
                                </div>

                                <span class="date">há 1h</span>
                            </div>

                            <div class="activity-movie">
                                <div class="movie-img"></div>

                                <span class="movie-name">A noite dos esquecidos (2001)</span>
                            </div>
                        </div>
                    </div>

                    <div class="watched-movies">
                        @foreach($usuario->filmesAssistidos as $filme)
                        <div class="watched-movie">
                            <div class="movie-img">
                                <img src="{{ asset('storage/' . $filme->capa) }}" alt="">
                            </div>

                            <div class="watched-movie-info">
                                <span class="watched-movie-title">{{$filme->nome }}</span>

                                <div class="movie-rating">
                                    <span class="movie-stars-count">{{ round($filme->notaMedia) }}</span>

                                    <div class="star">
                                        <img src="{{ asset('imgs/side-reviews.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="reviews hidden">
                        @foreach ($usuario->avaliacoes as $avaliacao)
                        <div class="review">
                            <div class="review-header">
                                <div class="review-user">
                                    <div class="user-img"></div>

                                    <span class="user-name">{{ $usuario->nome }}</span>
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

                <div class="lists hidden">
                    @foreach($usuario->listas as $lista)
                    <div class="list">
                        <div class="list-info">
                            <span class="list-updated">
                                Atualizada {{ $lista->getTempoDesdeUltimaAtualizacao() }}
                            </span>
                        </div>

                        <div class="picture">
                            <div class="img"></div>

                            <div class="img"></div>

                            <div class="img"></div>

                            <div class="img"></div>
                        </div>

                        <span class="list-name">{{ $lista->nome }}</span>

                        <div class="list-quantity">
                            <img src="{{ asset('imgs/side-movies.png') }}" alt="">

                            <span class="quantity">{{ $lista->filmes->count() }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>
    </main>
    </div>

    <div id="profile-modal-fade" class="hidden">
        <div id="profile-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Editar usuário
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="modal-body">
                @csrf

                <div class="form-user-img">
                    <div class="img-preview">
                        <img src="{{ $usuario->fotoPerfil ? asset('storage/' . $usuario->fotoPerfil) : ''}}" alt="">

                        <label for="change-img-btn" class="change-img">
                            <img src="{{ asset('imgs/camera.png') }}" alt="">
                        </label>
                    </div>

                    <input type="file" id="change-img-btn" style="display: none;" accept="image/*" name="fotoPerfil">
                </div>

                <div class="form-group">
                    <label for="form-nome">Nome</label>

                    <input type="text" id="form-nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="form-email">Email</label>

                    <input type="email" id="form-email" name="email" required>
                </div>
            </form>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="delete-user-btn">
                        <span>
                            Excluir conta
                        </span>
                    </button>

                    <div class="actions">
                        <button id="cancel-edit-btn">
                            <span>
                                Cancelar
                            </span>
                        </button>

                        <button id="save-edit-btn">
                            <span>
                                Salvar
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/perfil-menu.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const usuarioId = Number(document.querySelector('main').dataset.usuarioId);
            const usuarioNome = document.querySelector('main').dataset.usuarioNome;
            const usuarioEmail = document.querySelector('main').dataset.usuarioEmail;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const tabs = document.querySelector('.tabs');
            const allTabs = tabs.querySelectorAll('.tab');
            const tabContent = document.querySelector('.tab-content');
            const tabContentDivs = document.querySelectorAll('.tab-content > div');

            allTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    allTabs.forEach(otherTabs => otherTabs.classList.remove('active'));

                    tab.classList.add('active');

                    tabContentDivs.forEach(tabContDiv => {
                        if (tab.dataset.targetTab !== tabContDiv.className) {
                            if (!(tabContDiv.classList.contains('hidden'))) {
                                tabContDiv.classList.add('hidden');
                            }
                        }
                    });

                    tabContent.querySelector(`.${tab.dataset.targetTab}`).classList.remove('hidden');
                });
            });

            const inputImagem = document.querySelector('#change-img-btn');
            const previewImagem = document.querySelector('.img-preview img');

            inputImagem.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];

                    if (!file.type.startsWith('image/')) {
                        console.error("O arquivo selecionado não é uma imagem.");
                        previewImagem.src = "";
                        previewImagem.style.display = 'none';
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(ev) {
                        previewImagem.src = ev.target.result;
                        previewImagem.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            });

            const formEdicao = document.querySelector('.modal-body');
            const saveBtn = document.querySelector('#save-edit-btn');
            const cancelBtn = document.querySelector('#cancel-edit-btn');

            saveBtn.addEventListener('click', salvarEdicao);
            cancelBtn.addEventListener('click', fecharModalEdicao);

            const editProfileBtn = document.querySelector('#edit-profile-btn');

            editProfileBtn.addEventListener('click', abrirModalEdicao);

            function abrirModalEdicao() {
                document.querySelector('#form-nome').value = usuarioNome;
                document.querySelector('#form-email').value = usuarioEmail;
                document.querySelector('#profile-modal-fade').classList.remove('hidden');
            }

            function fecharModalEdicao() {
                document.querySelector('#form-nome').value = "";
                document.querySelector('#form-email').value = "";
                document.querySelector('#profile-modal-fade').classList.add('hidden');
            }

            async function salvarEdicao() {
                const url = "../api/usuarios/" + usuarioId;

                const formElement = document.querySelector('.modal-body');
                const formData = new FormData(formElement);

                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert('Perfil atualizado com sucesso!');
                        location.reload();
                    }
                } catch (error) {
                    console.error('Erro de conexão:', error);
                    alert('Não foi possível conectar ao servidor para atualizar o perfil.');
                } finally {
                    fecharModalEdicao();
                }
            }
        });
    </script>
</body>

</html>
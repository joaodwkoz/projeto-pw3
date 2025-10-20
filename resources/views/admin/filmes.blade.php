<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/filmes.css') }}">
</head>
<body>
    <div id="filme">
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
                    <a href="">
                        <div class="icon">
                            <img src="{{ url('imgs/side-reviews.png')}}" alt="">
                        </div>

                        <span class="text">Avaliações</span>
                    </a>
                </li>

                <li>
                    <a href="">
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
                <div class="list">
                    <div class="list-header">
                        <span class="content-title">Lista de filmes</span>

                        <button id="movie-add-btn">
                            <span>
                                Adicionar filme
                            </span>
                        </button>
                    </div>
                </div>

                <div class="movies-list">
                    <div class="movies-list-header">
                        <div class="movies-header-col">
                            <span>
                                Nome
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Diretor
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Lançamento
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Sinopse
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Classificação
                            </span>
                        </div>
                        
                        <div class="movies-header-col">
                            <span>
                                Trailer
                            </span>
                        </div>

                        <div class="movies-header-col">
                            <span>
                                Ações
                            </span>
                        </div>
                    </div>

                    <div class="movies-list-rows">
                        @foreach($filmes as $filme)
                            <div class="movies-list-row" data-filme-id="{{ $filme->id }}">
                                <div class="movies-list-col">
                                    <div class="movie-img">
                                        <img src="{{ asset('storage/' . $filme->capa) }}" alt="">
                                    </div>

                                    <span>
                                        {{ $filme->nome }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->diretor }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->ano_lancamento }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        @if(strlen($filme->sinopse) > 30)
                                            {{ substr($filme->sinopse, 0, 27) . ' [...]' }} 
                                        @else
                                            {{ $filme->sinopse }}
                                        @endif
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        {{ $filme->classificacao->nome }}
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <span>
                                        <a href="{{ $filme->trailer }}" class="trailer-link">
                                            Ver
                                        </a>
                                    </span>
                                </div>

                                <div class="movies-list-col">
                                    <button class="action-btn ver">
                                        <img src="{{ asset('imgs/ver.png') }}" alt="">
                                    </button>

                                    <button class="action-btn editar">
                                        <img src="{{ asset('imgs/editar.png') }}" alt="">
                                    </button>

                                    <button class="action-btn excluir">
                                        <img src="{{ asset('imgs/deletar.png') }}" alt="">
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="movie-modal-fade" class="hidden">
        <div id="movie-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Editar filme
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="modal-body" id="movie-form">
                @csrf

                <div class="form-movie-img">
                    <div class="img-preview">
                        <img src="{{''}}" alt="">

                        <label for="change-img-btn" class="change-img">
                            <img src="{{ asset('imgs/camera.png') }}" alt="">
                        </label>
                    </div>

                    <input type="file" id="change-img-btn" style="display: none;" accept="image/*" name="capa">
                </div>

                <div class="form-group">
                    <label for="form-nome">Nome</label>

                    <input type="text" id="form-nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="form-email">Diretor</label>

                    <input type="text" id="form-diretor" name="diretor" required>
                </div>

                <div class="form-group">
                    <label for="form-ano">Lançamento</label>

                    <input type="number" id="form-ano" name="ano_lancamento" required>
                </div>

                <div class="form-group" style="align-items: center">
                    <label>Classificação</label>

                    <div class="selected-option">
                        <span>
                            Livre
                        </span>
                    </div>

                    <div class="dropdown-menu hidden">
                        @foreach($classificacoes as $classificacao)
                            <button class="dropdown-btn" type="button" data-classificacao-id="{{ $classificacao->id }}">
                                <span>
                                    {{ $classificacao->nome }}
                                </span>
                            </button>
                        @endforeach
                   </div>
                </div>

                <div class="form-group">
                    <label>Gênero(s)</label>

                    <div class="chip-input">
                        @foreach($generos as $genero)
                            <button class="option" type="button" data-genero-id="{{ $genero->id }}">
                                <span>
                                    {{ $genero->nome }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Sinopse</label>

                    <textarea id="review-comment" name="sinopse"></textarea>
                </div>

                <div class="form-group">
                    <label>Trailer</label>

                    <input type="text" id="form-diretor" name="trailer" required>
                </div>
            </form>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="delete-movie-btn">
                        <span>
                            Excluir filme
                        </span>
                    </button>

                    <div class="actions">
                        <button id="cancel-movie-btn">
                            <span>
                                Cancelar
                            </span>
                        </button>

                        <button id="save-movie-btn">
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
            const modal = document.querySelector('#movie-modal-fade');
            const nomeInput = document.querySelector('input[name="nome"]');
            const diretorInput = document.querySelector('input[name="diretor"]');
            const lancamentoInput = document.querySelector('input[name="ano_lancamento"]');
            const sinopseInput = document.querySelector('textarea[name="sinopse"]');
            const trailerInput = document.querySelector('input[name="trailer"]');

            let filmeId = -1;
            let editMode = false;
            let readOnlyMode = false;

            const fecharModal = () => modal.classList.add('hidden');

            const abrirModal = () => modal.classList.remove('hidden');

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

            const disableInputs = () => {
                [inputImagem, nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.disabled = true);
            }

            const enableInputs = () => {
                [inputImagem, nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.disabled = false);
            }

            let generos = [];
            const chipInputOptions = document.querySelectorAll('.option');

            chipInputOptions.forEach(chipInputOption => {
                chipInputOption.addEventListener('click', () => {
                    if (!readOnlyMode) {
                        const id = Number(chipInputOption.dataset.generoId);

                        const index = generos.indexOf(id); 

                        if (chipInputOption.classList.contains('selected')) {
                            if (index > -1) {
                                generos.splice(index, 1);
                            }
                            chipInputOption.classList.remove('selected');
                        } else {
                            if (index === -1) { 
                                generos.push(id);
                            }
                            chipInputOption.classList.add('selected');
                        }
                        
                        console.log("Gêneros Ativos:", generos);
                    }
                });
            });

            const dropdownSelectedOption = document.querySelector('.selected-option');
            const dropdownSelectedOptionSpan = dropdownSelectedOption.querySelector('span');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            let classificacaoId = 1;

            dropdownSelectedOption.addEventListener('click', () => {
                if (!readOnlyMode) {
                    if (dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.remove('hidden');
                    } else {
                        dropdownMenu.classList.add('hidden');
                    }
                }
            });

            const dropdownBtns = dropdownMenu.querySelectorAll('.dropdown-btn');

            dropdownBtns.forEach(dropdownBtn => {
                dropdownBtn.addEventListener('click', () => {
                    if (!readOnlyMode) {
                        const novoTexto = dropdownBtn.querySelector('span').textContent.trim();
                        
                        dropdownSelectedOptionSpan.textContent = novoTexto; 
                        
                        classificacaoId = dropdownBtn.dataset.classificacaoId;

                        dropdownMenu.classList.add('hidden');
                    }
                })
            });

            const clearInputs = () => {
                [nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.value = '');

                generos = [];

                editMode = false;
                readOnlyMode = false;

                chipInputOptions.forEach(chipInputOption => {
                    chipInputOption.classList.remove('selected');
                });

                classificacaoId = 1;

                dropdownSelectedOptionSpan.textContent = 'Livre'; 
            }

            const verBtns = document.querySelectorAll('.action-btn.ver');
            const editarBtns = document.querySelectorAll('.action-btn.editar');
            const deletarBtns = document.querySelectorAll('.action-btn.excluir');

            verBtns.forEach(verBtn => {
                verBtn.addEventListener('click', (e) => {
                    filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

                    readOnlyMode = true;

                    disableInputs();
                    clearInputs();

                    fetchMovieById(filmeId);

                    abrirModal();
                });
            });

            editarBtns.forEach(editarBtn => {
                editarBtn.addEventListener('click', (e) => {
                    filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

                    readOnlyMode = false;
                    editMode = true;

                    enableInputs();

                    clearInputs();

                    fetchMovieById(filmeId);

                    abrirModal();
                });
            });

            deletarBtns.forEach(deletarBtn => {
                deletarBtn.addEventListener('click', (e) => {
                    filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

                    deleteMovie(filmeId);
                });
            });

            const saveMovieBtn = document.querySelector('#save-movie-btn');
            const cancelMovieBtn = document.querySelector('#cancel-movie-btn');
            const modalCloseBtn = document.querySelector('.modal-header-close');
            const addMovieBtn = document.querySelector('#movie-add-btn')

            saveMovieBtn.addEventListener('click', () => {
                if (readOnlyMode) {
                    fecharModal();
                } else {
                    saveMovie(editMode);
                }
            });

            [cancelMovieBtn, modalCloseBtn].forEach(cancel => {
                cancel.addEventListener('click', () => {
                    clearInputs();
                    fecharModal();
                });
            });

            addMovieBtn.addEventListener('click', () => {
                editMode = false;
                abrirModal();
            });

            async function saveMovie(edit = false) {
                const url = edit ? `../api/filmes/${filmeId}` : '../api/filmes/';

                const formBody = document.querySelector('#movie-form');

                const formData = new FormData(formBody);
                
                formData.append('classificacao_id', classificacaoId);

                generos.forEach(generoId => {
                    formData.append('generos[]', generoId); 
                });

                if (edit) {
                    formData.append('_method', 'PUT');
                }

                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    fecharModal();

                    alert(edit ? 'Editado com sucesso!' : 'Salvo com sucesso!');
                    location.reload();
                });
            }

            async function deleteMovie(filmeId) {
                if (confirm('Deseja mesmo excluir o filme?')) {
                    const url = "../api/filmes/" + filmeId;

                    await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Falha ao buscar filme.');
                        return res.json();
                    })
                    .then(data => {
                        alert('Deletado com sucesso!');
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Erro ao deletar o filme:', error);
                        alert('Não foi possível deletar o filme.');
                    });
                }
            }

            async function fetchMovieById(filmeId) {
                document.querySelectorAll('.chip-input .option').forEach(opt => {
                    opt.classList.remove('selected');
                });

                generos = [];

                const url = `../api/filmes/${filmeId}`;

                await fetch(url)
                .then(res => {
                    if (!res.ok) throw new Error('Falha ao buscar filme.');
                    return res.json();
                })
                .then(data => {
                    previewImagem.src = document.querySelector('main').dataset.storageUrl + "/" + data.capa;
                    nomeInput.value = data.nome || '';
                    diretorInput.value = data.diretor || '';
                    lancamentoInput.value = Number(data.ano_lancamento) || '';
                    sinopseInput.value = data.sinopse || '';
                    trailerInput.value = data.trailer || '';
                    data.generos.forEach(genero => {
                        const chipBtn = document.querySelector(`.chip-input button[data-genero-id="${genero.id}"]`);
                        if (chipBtn) {
                            chipBtn.classList.add('selected');
                            generos.push(genero.id);
                        }
                    });

                    if (data.classificacao) {
                        classificacaoId = data.classificacao.id;
                        dropdownSelectedOptionSpan.textContent = data.classificacao.nome;
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar detalhes do filme:', error);
                    alert('Não foi possível carregar os detalhes do filme.');
                });
            }
        });
    </script>
</body>
</html>
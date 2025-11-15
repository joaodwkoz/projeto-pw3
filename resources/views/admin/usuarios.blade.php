<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="{{ url('css/dashboard/usuarios.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/dialog-modal.css') }}">
    <link rel="stylesheet" href="{{ url('css/components/alert-dialog.css') }}">
</head>
<body>
    <div id="usuarios" data-imgs-url="{{ url('imgs/') }}">
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
                            <img src="{{ url('imgs/side-users.png')}}" alt="">
                        </div>

                        <span class="text">Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.usuarios') }}" class="active">
                        <div class="icon">
                            <img src="{{ url('imgs/side-users.png')}}" alt="">
                        </div>

                        <span class="text">Filmes</span>
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
                    <input type="text" placeholder="Pesquisar por usuar$usuarios, diretores, etc.">
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
                        <span class="content-title">Lista de usuários</span>

                        <button id="user-add-btn">
                            <span>
                                Adicionar usuário
                            </span>
                        </button>
                    </div>
                </div>

                <div class="users-list">
                    <div class="users-list-header">
                        <div class="users-header-col">
                            <span>
                                Nome
                            </span>
                        </div>

                        <div class="users-header-col">
                            <span>
                                Email
                            </span>
                        </div>

                        <div class="users-header-col">
                            <span>
                                Tipo
                            </span>
                        </div>

                        <div class="users-header-col">
                            <span>
                                Status
                            </span>
                        </div>

                        <div class="users-header-col">
                            <span>
                                Ações
                            </span>
                        </div>
                    </div>

                    <div class="users-list-rows">
                        @foreach($usuarios as $usuario)
                            <div class="users-list-row" data-usuario-id="{{ $usuario->id }}">
                                <div class="users-list-col">
                                    <span>
                                        {{ $usuario->nome }}
                                    </span>
                                </div>

                                <div class="users-list-col">
                                    <span>
                                        {{ $usuario->email }}
                                    </span>
                                </div>

                                <div class="users-list-col">
                                    <span>
                                        {{ $usuario->ehAdmin }}
                                    </span>
                                </div>
                        
                                <div class="users-list-col">
                                    <span class="status {{ $usuario->status }}">
                                        {{ $usuario->showStatusHTML() }}
                                    </span>
                                </div>

                                <div class="users-list-col">
                                    <button class="action-btn ver">
                                        <img src="{{ asset('imgs/ver.png') }}" alt="">
                                    </button>

                                    <button class="action-btn editar">
                                        <img src="{{ asset('imgs/editar.png') }}" alt="">
                                    </button>

                                    @if($usuario->status == 'deletado')
                                        <button class="action-btn reativar">
                                            <img src="{{ asset('imgs/reativar.png') }}" alt="">
                                        </button>
                                    @else
                                        <button class="action-btn excluir">
                                            <img src="{{ asset('imgs/deletar.png') }}" alt="">
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="user-modal-fade" class="hidden">
        <div id="user-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Editar usuário
                </span>

                <button class="modal-header-close">
                    <img src="{{ asset('imgs/close.png') }}" alt="">
                </button>
            </div>

            <form class="modal-body" id="user-form">
                @csrf

                <div class="form-user-img">
                    <div class="img-preview">
                        <img src="{{''}}" alt="">

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

                    <input type="text" id="form-email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="form-ano">Tipo de conta</label>

                    <div class="radio-group">
                        <input type="radio" id="radio-usuario" name="ehAdmin" value="0">

                        <label for="radio-usuario">
                            <div class="radio-box">
                                <div class="radio-checked"></div>
                            </div>

                            <span>
                                Usuário
                            </span>
                        </label>

                        <input type="radio" id="radio-admin" name="ehAdmin" value="1">

                        <label for="radio-admin">
                            <div class="radio-box">
                                <div class="radio-checked"></div>
                            </div>

                            <span>
                                Admin
                            </span>
                        </label>
                    </div>
                </div>
            </form>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="cancel-user-btn">
                        <span>
                            Cancelar
                        </span>
                    </button>

                    <button id="save-user-btn">
                        <span>
                            Salvar
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-modal-fade" class="hidden">
        <div id="dialog-modal">
            <div class="modal-header">
                <img src="{{ url('imgs/modal-sucesso.png') }}" alt="">
            </div>

            <div class="modal-body">
                <span class="title">
                    Sucesso!
                </span>

                <span class="text">
                    Adicionado com sucesso!
                </span>

                <div class="info">
                    <span>
                        Mais informações:
                    </span>

                    <div class="box">
                        <span>
                            Erro ao salvar o nome
                        </span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="continue-dialog-btn">
                    <span>
                        Continuar
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div id="alert-modal-fade" class="hidden">
        <div id="alert-modal">
            <div class="modal-header">
                <span class="modal-title">
                    Você tem certeza?                    
                </span>
            </div>

            <div class="modal-body">
                <span class="text">
                    Essa ocasionará no bloqueio do usuário de acessar a sua própria conta
                </span>
            </div>

            <div class="modal-footer">
                <div class="modal-btns">
                    <button id="cancel-alert-btn">
                        <span>
                            Cancelar
                        </span>
                    </button>

                    <button id="continue-alert-btn">
                        <span>
                            Continuar
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/components/dialog-modal.js') }}"></script>
    <script src="{{ asset('js/components/alert-dialog.js') }}"></script>
    <script src="{{ asset('js/perfil-menu.js') }}"></script>
    <script src="{{ asset('js/admin/usuarios/dom-elements.js') }}"></script>
    <script src="{{ asset('js/admin/usuarios/modals.js') }}"></script>
    <script src="{{ asset('js/admin/usuarios/api.js') }}"></script>
    <script src="{{ asset('js/admin/usuarios/events.js') }}"></script>
</body>
</html>
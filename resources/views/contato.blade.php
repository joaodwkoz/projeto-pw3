<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filme</title>
    <link rel="stylesheet" href="{{ url('css/contato.css') }}">
</head>
<body>
    <div id="contato">
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
                    <a href="{{ route('contato') }}" class="active">
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

        <main id="app">
           <form method="POST" action="{{ route('contato.enviar') }}">
                @csrf
                <span class="title">Fale conosco</span>

                <div class="subtext">
                    <span>Ou apenas envie um email para</span>
                    <a href="" class="email">trabalhopw3jkmv@gmail.com</a>
                </div>

                <div class="info">
                    <span>Nome</span>

                    <div class="info-input">
                        <img class="icon" src="{{ asset('imgs/contact-user.png') }}" alt="">

                        <input name="nome" type="text" placeholder="Digite seu nome aqui">
                    </div>
                </div>

                <div class="info">
                    <span>Email</span>

                    <div class="info-input">
                        <img class="icon" src="{{ asset('imgs/contact-email.png') }}" alt="">

                        <input name="email" type="email" placeholder="Digite seu email aqui">
                    </div>
                </div>

                <div class="info">
                    <span>Assunto</span>

                    <div class="info-input">
                        <select name="assunto">
                            <option value="sugestao">Sugestão</option>
                            <option value="duvida">Dúvida</option>
                            <option value="problema">Problema</option>
                            <option value="denuncia">Denúncia</option>
                        </select>
                    </div>
                </div>

                <div class="info">
                    <span>Mensagem</span>

                    <div class="info-textarea">
                        <textarea name="mensagem" placeholder="Digite sua mensagem aqui"></textarea>
                    </div>
                </div>

                <button id="send-btn">
                    Enviar
                </button>
           </form>
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre</title>
    <link rel="stylesheet" href="{{ url('css/sobre.css') }}">
</head>
<body>
    <div id="about">
        <aside id="sidebar">
            <div class="logo"></div>

            <ul>
                <li>
                    <a href="{{ route('dashboard.index') }}">
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
                    <a href="" class="active">
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
        
        <main id="app">
            <span class="title">Sobre nós</span>

            <span class="about-text">
                O CinePop é um projeto criado na disciplina de Programação Web 3, inspirado no Letterboxd. Desenvolvido por João Pedro, Kauã, Marcos e Vitor, tem como objetivo oferecer uma plataforma simples e interativa para registrar, avaliar e descobrir filmes.
            </span>

            <div id="content">
                <div class="team">
                    @php
                        $assunto = 'Olá gostaria de falar sobre o Cinepop';

                        $mensagem = "Olá, tenho uma dúvida sobre o Cinepop. Por favor, entre em contato o quanto antes.";

                        $emails = [
                            'João' => 'fjoaopedro1302@gmail.com',
                            'Kauã' => 'kauad.cavalcante@gmail.com',
                            'Marcos' => 'marcosvinicius.cordeiro.2020@gmail.com',
                            'Vitor' => 'vitor@gmail.com',
                        ];

                        if(!function_exists('hrefToMail')){
                            function hrefToMail($nome, array $emails, string $assunto, string $mensagem): string
                            {
                                $ass = urlencode($assunto);
                                $msg = urlencode($mensagem);

                                return "mailto:{$emails[$nome]}?subject={$ass}&body={$msg}";
                            }
                        }
                    @endphp

                    @foreach($emails as $nome => $email)
                        <div class="dev">
                            <div class="img"></div> <!-- Depois aqui tem que virar uma imagem mesmo -->

                            <div class="info-overlay">
                                <div class="dev-info">
                                    <span class="dev-name">{{ $nome }}</span>
                                </div>

                                <div class="separator"></div>

                                <div class="dev-links">
                                    <a class="dev-link">
                                        <img src="{{ asset('imgs/icon-github.png') }}" alt="">
                                    </a>

                                    <a class="dev-link" href="{{ hrefToMail($nome, $emails, $assunto, $mensagem) }}">
                                        <img src="{{ asset('imgs/icon-gmail.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</body>
</html>
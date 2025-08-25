<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Contato</title>
    <link href="{{ url('css/contato.css') }}" rel="stylesheet">
</head>
<body>

    <div class="boxConteiner">
        <form action="/criar-contato" method="post" >
            @csrf
            <button>⇦   Voltar</button>
            <h1 class="txt">Fale conosco</h1>
            <div class="top">
                <input type="text" name="txNome" class="inTop" placeholder="Nome completo">
                <input type="email" name="txEmail" id="inEmail" class="inTop" placeholder="Email"> 
            </div>

            <input type="text" name="txAssunto" id="inAssunto" placeholder="Assunto">

            <textArea id="txtArea" name="txMensagem" class="inFooter" placeholder="Mensagem"></textArea>
        </form>        
    </div>

    <div class="boxConteiner" id="box2">

    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($contato as $c)
    <p>{{$c->id}}</p>
    <p>{{$c->nome}}</p>
    <p>{{$c->email}}</p>
    <p>{{$c->assunto}}</p>
    <p>{{$c->menssangem}}</p>
    @endforeach
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <h1>Funcionários</h1>

        @foreach($funcionarios as $f)
        <p> {{$f->nomeFuncionario}} {{$f->dateNascFuncionario}}</p>
        @endforeach


        <a href="/download-pdf"> PDF </a>

</body>
</html>
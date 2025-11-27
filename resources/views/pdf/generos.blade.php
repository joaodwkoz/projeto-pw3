<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Gêneros</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Relatório de Gêneros e Contagem de Filmes</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Gênero</th>
                <th>Filmes Cadastrados</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($generos as $genero)
            <tr>
                <td>{{ $genero->id }}</td>
                <td>{{ $genero->nome }}</td>
                <td>{{ $genero->filmes_count }}</td> 
                <td>{{ $genero->status ?? 'Ativo' }}</td> 
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
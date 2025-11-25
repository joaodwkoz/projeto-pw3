<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard PDF</title>
    <style>
        body { font-family: sans-serif; }
        h1 { font-size: 20px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

    <h1>Resumo do Dashboard</h1>

    <h2>Total de Usuários</h2>
    <p>{{ $totalUsers }}</p>

    <h2>Total de Filmes</h2>
    <p>{{ $totalMovies }}</p>

    <h2>Top 5 Usuários</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Filmes Assistidos</th>
        </tr>
        @foreach($topUsers as $u)
            <tr>
                <td>{{ $u->nome }}</td>
                <td>{{ $u->filmes_assistidos_count }}</td>
            </tr>
        @endforeach
    </table>

    <h2>Filmes em Alta</h2>
    <table>
        <tr>
            <th>Filme</th>
            <th>Avaliações</th>
        </tr>
        @foreach($topMovies as $m)
            <tr>
                <td>{{ $m->nome }}</td>
                <td>{{ $m->avaliacoes_count }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>

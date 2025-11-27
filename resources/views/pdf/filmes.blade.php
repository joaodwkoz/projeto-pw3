<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Filmes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

<h2>Relatório de Filmes</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Filme</th>
            <th>Ano</th>
            <th>Nota Média</th>
            <th>Gêneros</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($filmes as $filme)
        <tr>
            <td>{{ $filme->id }}</td>
            <td>{{ $filme->nome }}</td>
            <td>{{ $filme->ano ?? $filme->ano_lancamento }}</td> 
            
            <td>
                @if ($filme->avaliacoes_avg_nota)
                    {{ number_format($filme->avaliacoes_avg_nota, 2) }}
                @else
                    N/A
                @endif
            </td>
            
            <td>{{ $filme->generos->pluck('nome')->implode(', ') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
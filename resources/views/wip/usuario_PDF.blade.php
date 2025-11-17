<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #444;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            letter-spacing: 1px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
            font-size: 14px;
        }

        th {
            background: #f0f0f0;
            text-align: left;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Relatório de Usuários</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuario as $f)
            <tr>
                <td>{{ $f->nomeUsuario }}</td>
                <td>{{ $f->emailUsuario }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Relatório gerado automaticamente - {{ date('d/m/Y H:i') }}
    </div>

</body>
</html>
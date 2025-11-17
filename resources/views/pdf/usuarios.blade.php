<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            color: #111;
        }

        .header {
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #111;
        }

        .header h1 {
            font-size: 24px;
            color: #1b1b1b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #131313;
            padding: 8px 12px;
            font-size: 14px;
        }

        th {
            background: #f0f0f0;
            text-align: left;
            font-weight: 500;
        }

        thead {
            font-family: 'Poppins', sans-serif;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #181818;
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
                <th>Tipo</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->ehAdmin ? 'Admin' : 'Usuário' }}</td>
                <td>Ativo</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Relatório gerado automaticamente - {{ date('d/m/Y H:i') }}
    </div>

</body>
</html>
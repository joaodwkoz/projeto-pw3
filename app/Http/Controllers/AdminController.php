<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function download()
    {
        $sql = 'SELECT * FROM filmes';
        $queryJson = DB::select($sql);

        $filename = 'filmes.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($queryJson) {
            $file = fopen('php://output', 'w');

            // Cabeçalho do CSV
            $header = [
                "ID", "nome", "diretor", "ano_lancamento", "classificacao_id",
                "sinopse", "trailer", "capa", "created_at", "updated_at"
            ];

            // Converter cabeçalho para ISO-8859-1
            $header = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $header, ';');

            // Escrever linhas
            foreach ($queryJson as $d) {
                $row = [
                    $d->id,
                    mb_convert_encoding($d->nome, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($d->diretor, 'ISO-8859-1', 'UTF-8'),
                    $d->ano_lancamento,
                    $d->classificacao_id,
                    mb_convert_encoding($d->sinopse, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($d->trailer, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($d->capa, 'ISO-8859-1', 'UTF-8'),
                    $d->created_at,
                    $d->updated_at,
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

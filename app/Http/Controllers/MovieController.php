<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Http;

class MovieController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('q');
        $results = [];

        if ($query) {
            $response = Http::get(env('OMDB_API_URL'), [
                'apikey' => env('OMDB_API_KEY'),
                's' => $query
            ]);

            $json = $response->json();
            $results = $json['Search'] ?? [];
        }

        return view('movies.index', compact('results', 'query'));
    }

    public function show($imdbID) {
        $response = Http::get(env('OMDB_API_KEY'), [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $imdbID,
            'plot' => 'full'
        ]);

        $movie = $response->json();

        if ($movie['Response'] === 'False') {
            abort(404, 'Filme não encontrando');
        }

        return view('movies.show', compact('movie'));
    }
}



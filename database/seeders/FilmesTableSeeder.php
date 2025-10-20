<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FilmesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('filmes');

        $filmes = [
            [
                'nome' => 'Clube da Luta',
                'diretor' => 'David Fincher',
                'ano_lancamento' => 1999,
                'classificacao_id' => 1,
                'sinopse' => 'Um homem de escritório insone, procurando uma maneira de mudar sua vida, cruza o caminho com um fabricante de sabão diabólico e eles formam um clube de luta clandestino que se transforma em algo muito, muito maior.',
                'trailer' => 'https://www.youtube.com/watch?v=SUXWAEX2jlg',
                'capa' => database_path('seeders/images/fight_club_capa.jfif'),
                'generos' => [4, 8]
            ],
            [
                'nome' => 'Matrix',
                'diretor' => 'Lana Wachowski, Lilly Wachowski',
                'ano_lancamento' => 1999,
                'classificacao_id' => 1,
                'sinopse' => 'Um hacker de computador aprende com misteriosos rebeldes sobre a verdadeira natureza de sua realidade e seu papel na guerra contra seus controladores.',
                'trailer' => 'https://www.youtube.com/watch?v=m8e-FF8MsqU',
                'capa' => database_path('seeders/images/matrix_capa.jfif'),
                'generos' => [1, 6]
            ],
            [
                'nome' => 'A Origem',
                'diretor' => 'Christopher Nolan',
                'ano_lancamento' => 2010,
                'classificacao_id' => 1,
                'sinopse' => 'Um ladrão que rouba segredos corporativos através do uso da tecnologia de compartilhamento de sonhos recebe a tarefa inversa de plantar uma ideia na mente de um C.E.O.',
                'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
                'capa' => database_path('seeders/images/inception_capa.jfif'),
                'generos' => [1, 2, 6]
            ],
            [
                'nome' => 'Parasita',
                'diretor' => 'Bong Joon Ho',
                'ano_lancamento' => 2019,
                'classificacao_id' => 1,
                'sinopse' => 'A ganância e a discriminação de classe ameaçam o relacionamento simbiótico recém-formado entre a rica família Park e o pobre clã Kim.',
                'trailer' => 'https://www.youtube.com/watch?v=5xH0HfJHsaY',
                'capa' => database_path('seeders/images/parasite_capa.jfif'),
                'generos' => [3, 4, 8]
            ],
            [
                'nome' => 'Psicopata Americano',
                'diretor' => 'Mary Harron',
                'ano_lancamento' => 2000,
                'classificacao_id' => 1,
                'sinopse' => 'Um rico executivo de banco de investimentos de Nova York esconde seu alter ego psicopata de seus colegas de trabalho e amigos enquanto mergulha mais fundo em suas fantasias violentas e hedonistas.',
                'trailer' => 'https://www.youtube.com/watch?v=5Yle_YJ_a_k',
                'capa' => database_path('seeders/images/american_psycho_capa.jfif'),
                'generos' => [4, 9]
            ],
        ];

        foreach($filmes as $filmeData){
            $caminhoCapa = Storage::disk('public')->putFile('filmes/capas', new File($filmeData['capa']));

            $filme = Filme::create([
                'nome' => $filmeData['nome'],
                'diretor' => $filmeData['diretor'],
                'ano_lancamento' => $filmeData['ano_lancamento'],
                'classificacao_id' => $filmeData['classificacao_id'],
                'sinopse' => $filmeData['sinopse'],
                'trailer' => $filmeData['trailer'],
                'capa' => $caminhoCapa,
            ]);

            $filme->generos()->sync($filmeData['generos']);
        }
    }
}
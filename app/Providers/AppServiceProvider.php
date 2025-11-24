<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Filme;
use App\Models\Usuario;
use App\Models\Genero;
use App\Observers\AtividadeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot()
    {
        Filme::observe(AtividadeObserver::class);
        Usuario::observe(AtividadeObserver::class);
        Genero::observe(AtividadeObserver::class);
    }
}

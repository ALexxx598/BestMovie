<?php

namespace App\Providers;

use App\MovieDomain\Movie\Repository\MovieRepository;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;
use App\MovieDomain\Movie\Service\MovieService;
use App\MovieDomain\Movie\Service\MovieServiceInterface;
use Illuminate\Support\ServiceProvider;

class MovieServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerMovieService();
        $this->registerRepository();
    }

    private function registerMovieService(): void
    {
        $this->app->singleton(MovieServiceInterface::class, MovieService::class);
    }

    private function registerRepository()
    {
        $this->app->singleton(MovieRepositoryInterface::class, MovieRepository::class);
    }
}

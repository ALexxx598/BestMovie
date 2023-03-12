<?php

namespace App\Providers;

use App\MovieDomain\Category\Repository\CategoryRepositoryInterface;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\Repository\MovieRepository;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;
use App\MovieDomain\Movie\Service\MovieService;
use App\MovieDomain\Movie\Service\MovieServiceInterface;
use Illuminate\Support\ServiceProvider;

class MovieServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->registerMovieService();
        $this->registerRepository();
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        Movie::setCategoryRepositoryResolver(function (): CategoryRepositoryInterface {
            return $this->app[CategoryRepositoryInterface::class];
        });

        Movie::setCollectionRepositoryResolver(function (): CollectionRepositoryInterface {
            return $this->app[CollectionRepositoryInterface::class];
        });
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

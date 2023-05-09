<?php

namespace App\Providers;

use App\MovieDomain\Category\Repository\CategoryRepositoryInterface;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\Repository\MovieRepository;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;
use App\MovieDomain\Movie\Service\MovieService;
use App\MovieDomain\Movie\Service\MovieServiceInterface;
use App\MovieDomain\Storage\BestMovieCachedStorageServiceInterface;
use App\MovieDomain\Storage\BestMovieCachedStorageService;
use BestMovie\Common\BestMovieStorage\Service\BestMovieStorageServiceInterface;
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

        $this->registerBestMovieCachedStorageServiceInterface();
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

        Movie::setBestMovieCachedStorageServiceResolver(function (): BestMovieCachedStorageServiceInterface {
            return $this->app[BestMovieCachedStorageServiceInterface::class];
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

    private function registerBestMovieCachedStorageServiceInterface(): void
    {
        $this->app->singleton(
            BestMovieCachedStorageServiceInterface::class,
            BestMovieCachedStorageService::class
        );
    }
}

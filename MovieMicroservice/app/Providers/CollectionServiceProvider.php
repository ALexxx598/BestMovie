<?php

namespace App\Providers;

use App\MovieDomain\Collection\Repository\CollectionRepository;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\Collection\Service\CollectionService;
use App\MovieDomain\Collection\Service\CollectionServiceInterface;
use App\MovieDomain\MovieCollection\Repository\MovieCollectionRepository;
use App\MovieDomain\MovieCollection\Repository\MovieCollectionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CollectionServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->registerCollectionService();

        $this->registerCollectionRepository();

        $this->registerMovieCollectionRepository();
    }

    private function registerCollectionService(): void
    {
        $this->app->singleton(CollectionServiceInterface::class, CollectionService::class);
    }

    private function registerCollectionRepository(): void
    {
        $this->app->singleton(CollectionRepositoryInterface::class, CollectionRepository::class);
    }

    private function registerMovieCollectionRepository(): void
    {
        $this->app->singleton(MovieCollectionRepositoryInterface::class, MovieCollectionRepository::class);
    }
}

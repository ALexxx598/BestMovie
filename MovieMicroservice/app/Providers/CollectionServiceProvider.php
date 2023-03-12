<?php

namespace App\Providers;

use App\MovieDomain\Collection\Repository\CollectionRepository;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\Collection\Service\CollectionService;
use App\MovieDomain\Collection\Service\CollectionServiceInterface;
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
    }

    private function registerCollectionService(): void
    {
        $this->app->singleton(CollectionServiceInterface::class, CollectionService::class);
    }

    private function registerCollectionRepository(): void
    {
        $this->app->singleton(CollectionRepositoryInterface::class, CollectionRepository::class);
    }
}

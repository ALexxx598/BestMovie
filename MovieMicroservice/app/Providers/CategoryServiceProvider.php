<?php

namespace App\Providers;

use App\MovieDomain\Category\Repository\CategoryRepository;
use App\MovieDomain\Category\Repository\CategoryRepositoryInterface;
use App\MovieDomain\Category\Service\CategoryService;
use App\MovieDomain\Category\Service\CategoryServiceInterface;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCategoryService();
        $this->registerCategoryRepository();
    }

    private function registerCategoryService(): void
    {
        $this->app->singleton(CategoryServiceInterface::class, CategoryService::class);
    }

    private function registerCategoryRepository(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
    }
}

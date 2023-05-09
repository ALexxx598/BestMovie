<?php

namespace App\Providers;

use App\MovieDomain\Category\Repository\CategoryRepository;
use App\MovieDomain\Category\Repository\CategoryRepositoryInterface;
use App\MovieDomain\Category\Service\CategoryService;
use App\MovieDomain\Category\Service\CategoryServiceInterface;
use App\MovieDomain\MovieCategory\Repository\MovieCategoryRepository;
use App\MovieDomain\MovieCategory\Repository\MovieCategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCategoryService();
        $this->registerCategoryRepository();
        $this->registerMovieCategoryRepository();
    }

    private function registerCategoryService(): void
    {
        $this->app->singleton(CategoryServiceInterface::class, CategoryService::class);
    }

    private function registerCategoryRepository(): void
    {
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    private function registerMovieCategoryRepository(): void
    {
        $this->app->singleton(MovieCategoryRepositoryInterface::class, MovieCategoryRepository::class);
    }
}

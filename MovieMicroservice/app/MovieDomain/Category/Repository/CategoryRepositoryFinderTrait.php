<?php

namespace App\MovieDomain\Category\Repository;

use Closure;

trait CategoryRepositoryFinderTrait
{
    /**
     * @var Closure|null
     */
    private static ?Closure $categoryResolver = null;

    /**
     * @var CategoryRepositoryInterface|null
     */
    private static ?CategoryRepositoryInterface $categoryRepository;

    /**
     * @param Closure|null $categoryResolver
     */
    public static function setCategoryRepositoryResolver(?Closure $categoryResolver = null): void
    {
        self::$categoryRepository = null;

        self::$categoryResolver = $categoryResolver;
    }

    /**
     * @return CategoryRepositoryInterface
     */
    public static function getCategoryRepository(): CategoryRepositoryInterface
    {
        return self::$categoryRepository ?? self::$categoryRepository = call_user_func(self::$categoryResolver);
    }
}

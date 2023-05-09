<?php

namespace App\MovieDomain\Storage;

use Closure;

trait BestMovieCachedStorageServiceServiceFinderTrait
{
    /**
     * @var Closure|null
     */
    private static ?Closure $bestMovieCachedStorageServiceResolver = null;

    /**
     * @var BestMovieCachedStorageServiceInterface|null
     */
    private static ?BestMovieCachedStorageServiceInterface $bestMovieCachedStorageService = null;

    /**
     * @param Closure|null $collectionResolver
     */
    public static function setBestMovieCachedStorageServiceResolver(?Closure $cachedStorageServiceResolver = null): void
    {
        self::$bestMovieCachedStorageService = null;

        self::$bestMovieCachedStorageServiceResolver = $cachedStorageServiceResolver;
    }

    /**
     * @return BestMovieCachedStorageServiceInterface
     */
    public static function getBestMovieCachedStorageService(): BestMovieCachedStorageServiceInterface
    {
        return self::$bestMovieCachedStorageService
            ?? self::$bestMovieCachedStorageService = call_user_func(self::$bestMovieCachedStorageServiceResolver);
    }
}

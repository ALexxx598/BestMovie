<?php

namespace App\MovieDomain\Storage;

use BestMovie\Common\BestMovieStorage\Service\BestMovieStorageServiceInterface;
use Closure;

trait BestMovieStorageFinderTrait
{
    /**
     * @var Closure|null
     */
    private static ?Closure $bestMovieStorageServiceResolver = null;

    /**
     * @var BestMovieStorageServiceInterface|null
     */
    private static ?BestMovieStorageServiceInterface $bestMovieStorageService = null;

    /**
     * @param Closure|null $resolver
     */
    public static function setBestMovieStorageServiceResolver(?Closure $collectionResolver = null): void
    {
        self::$bestMovieStorageService = null;

        self::$bestMovieStorageServiceResolver = $collectionResolver;
    }

    /**
     * @return BestMovieStorageServiceInterface
     */
    public static function getBestMovieStorageService(): BestMovieStorageServiceInterface
    {
        return self::$bestMovieStorageService
            ?? self::$bestMovieStorageService = call_user_func(self::$bestMovieStorageServiceResolver);
    }
}

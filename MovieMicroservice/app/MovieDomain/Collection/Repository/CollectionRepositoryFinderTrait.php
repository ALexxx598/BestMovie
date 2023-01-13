<?php

namespace App\MovieDomain\Collection\Repository;

use Closure;

trait CollectionRepositoryFinderTrait
{
    /**
     * @var Closure|null
     */
    private static ?Closure $collectionResolver = null;

    /**
     * @var CollectionRepositoryInterface|null
     */
    private static ?CollectionRepositoryInterface $collectionRepository = null;

    /**
     * @param Closure|null $resolver
     */
    public static function setCollectionRepositoryResolver(?Closure $collectionResolver = null): void
    {
        self::$collectionRepository = null;

        self::$collectionResolver = $collectionResolver;
    }

    /**
     * @return CollectionRepositoryInterface
     */
    public static function getCollectionRepository(): CollectionRepositoryInterface
    {
        return self::$collectionRepository ?? self::$collectionRepository = call_user_func(self::$collectionResolver);
    }
}

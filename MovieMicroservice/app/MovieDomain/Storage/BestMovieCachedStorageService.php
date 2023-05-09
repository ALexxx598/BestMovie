<?php

namespace App\MovieDomain\Storage;

use BestMovie\Common\BestMovieStorage\Service\BestMovieStorageServiceInterface;
use Illuminate\Cache\Repository as Cache;

class BestMovieCachedStorageService implements BestMovieCachedStorageServiceInterface
{
    protected const ONE_HOUR = '60';

    /**
     * @param Cache $cache
     * @param BestMovieStorageServiceInterface $bestMovieCachedStorage
     */
    public function __construct(
        private Cache $cache,
        private BestMovieStorageServiceInterface $bestMovieCachedStorage,
    ) {
    }

    /**
     * @param int $movieId
     * @param string $path
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validatePath(int $movieId, string $path): bool
    {
        $key = sprintf('movieId:%s:file:%s', $movieId, $path);

        return $this->cache->get($key) ?? $this->cache->remember(
                $key,
                self::ONE_HOUR,
                function () use ($path): bool {
                    return $this->bestMovieCachedStorage->validatePath($path);
                }
            );
    }

    /**
     * @param int $movieId
     * @param string $path
     * @return string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPath(int $movieId, string $path): ?string
    {
        $key = sprintf('movieId:%s:file:%s', $movieId, $path);

        return $this->cache->get($key) ?? $this->cache->remember(
                $key,
                self::ONE_HOUR,
                function () use ($path): string {
                    return $this->bestMovieCachedStorage->getPath($path);
                }
            );
    }
}

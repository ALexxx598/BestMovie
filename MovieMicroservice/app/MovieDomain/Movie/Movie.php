<?php

namespace App\MovieDomain\Movie;

use App\MovieDomain\Category\Category;
use App\MovieDomain\Category\Filter\CategoryFilter;
use App\MovieDomain\Category\Repository\CategoryRepositoryFinderTrait;
use App\MovieDomain\Collection\Collection as MovieCollections;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\Repository\CollectionRepositoryFinderTrait;
use App\MovieDomain\Storage\BestMovieCachedStorageServiceServiceFinderTrait;
use Illuminate\Support\Collection;

class Movie
{
    use CategoryRepositoryFinderTrait;
    use CollectionRepositoryFinderTrait;
    use BestMovieCachedStorageServiceServiceFinderTrait;

    /**
     * @param int|null $id
     * @param string $name
     * @param MovieDescription $description
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     * @param Collection<Category>|null $categories
     * @param Collection<MovieCollections>|null $collections
     */
    public function __construct(
        private ?int $id = null,
        private string $name,
        private MovieDescription $description,
        private string $storageMovieUrl,
        private string $storageImageUrl,
        private ?Collection $categories = null,
        private ?Collection $collections = null,
    ) {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return MovieDescription
     */
    public function getDescription(): MovieDescription
    {
        return $this->description;
    }

    /**
     * @param MovieDescription $description
     * @return self
     */
    public function setDescription(MovieDescription $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getStorageMovieUrl(): string
    {
        return $this->storageMovieUrl;
    }

    /**
     * @return string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFullMoviePath(): ?string
    {
        return static::getBestMovieCachedStorageService()
            ->getPath(movieId: $this->getId(), path: $this->getStorageMovieUrl());
    }

    /**
     * @param string $storageMovieUrl
     * @return self
     */
    public function setStorageMovieUrl(string $storageMovieUrl): self
    {
        $this->storageMovieUrl = $storageMovieUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getStorageImageUrl(): string
    {
        return $this->storageImageUrl;
    }

    /**
     * @return string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFullImagePath(): ?string
    {
        return static::getBestMovieCachedStorageService()
            ->getPath(movieId: $this->getId(), path: $this->getStorageImageUrl());
    }

    /**
     * @param string $storageImageUrl
     * @return self
     */
    public function setStorageImageUrl(string $storageImageUrl): self
    {
        $this->storageImageUrl = $storageImageUrl;

        return $this;
    }

    /**
     * @return Collection<Category>
     */
    public function getCategories(): Collection
    {
        if ($this->getId() == null) {
            return new Collection([]);
        }

        return $this->categories
            ?? $this->categories = self::getCategoryRepository()->list(CategoryFilter::make(movieId: $this->getId()));
    }

    /**
     * @param Collection<Category>|null $categories
     * @return self
     */
    public function setCategories(?Collection $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<MovieCollections>|null
     */
    public function getCollections(): ?Collection
    {
        return $this->collections
            ?? $this->collections = $this::getCollectionRepository()->list(
                CollectionFilter::make(movieId: $this->getId())
            );
    }

    /**
     * @param Collection<MovieCollections>|null $collections
     * @return self
     */
    public function setCollections(?Collection $collections): self
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @param int $userId
     * @return Collection<int>
     */
    public function getUserCollectionIds(int $userId): Collection
    {
        return $this
            ->getCollections()
            ->filter(fn (MovieCollections $collection) => $collection->isBelongToUser($userId))
            ->map(fn (MovieCollections $collection) => $collection->getId());
    }
}

<?php

namespace App\MovieDomain\Movie;

use Illuminate\Support\Collection;

class Movie
{
    /**
     * @param int|null $id
     * @param string $name
     * @param array $description
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     * @param Collection|null $categories
     */
    public function __construct(
        private ?int $id = null,
        private string $name,
        private array $description,
        private string $storageMovieUrl,
        private string $storageImageUrl,
        private ?Collection $categories = null,
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
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * @param array $description
     * @return self
     */
    public function setDescription(array $description): self
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
     * @param string $storageImageUrl
     * @return self
     */
    public function setStorageImageUrl(string $storageImageUrl): self
    {
        $this->storageImageUrl = $storageImageUrl;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getCategories(): ?Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection|null $categories
     * @return self
     */
    public function setCategories(?Collection $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}

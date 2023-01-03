<?php

namespace App\MovieDomain\Movie\Payload;

class MovieCreatePayload
{
    /**
     * @param string $name
     * @param array $description
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     */
    private function __construct(
        private string $name,
        private array $description,
        private string $storageMovieUrl,
        private string $storageImageUrl,
    ) {
    }

    /**
     * @param string $name
     * @param array $description
     * @param string $storageMovieUrl
     * @param string $storageImageUrl
     * @return static
     */
    public static function make(
        string $name,
        array $description,
        string $storageMovieUrl,
        string $storageImageUrl,
    ): self {
        return new self(
            name: $name,
            description: $description,
            storageMovieUrl: $storageMovieUrl,
            storageImageUrl: $storageImageUrl
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStorageMovieUrl(): string
    {
        return $this->storageMovieUrl;
    }

    /**
     * @return string
     */
    public function getStorageImageUrl(): string
    {
        return $this->storageImageUrl;
    }
}

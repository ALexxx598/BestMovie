<?php

namespace App\MovieDomain\Movie\Payload;

use Illuminate\Support\Collection;

class MovieCollectionPayload
{
    /**
     * @param int $userId
     * @param int $movieId
     * @param Collection<int> $collectionIds
     */
    private function __construct(
        private int $userId,
        private int $movieId,
        private Collection $collectionIds,
    ) {
    }

    /**
     * @param int $userId
     * @param int $movieId
     * @param Collection<int> $collectionIds
     * @return static
     */
    public static function make(
        int $userId,
        int $movieId,
        Collection $collectionIds,
    ): self {
        return new self(
            userId: $userId,
            movieId: $movieId,
            collectionIds: $collectionIds
        );
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @param int $movieId
     * @return self
     */
    public function setMovieId(int $movieId): self
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCollectionIds(): Collection
    {
        return $this->collectionIds;
    }

    /**
     * @param Collection $collectionIds
     * @return self
     */
    public function setCollectionIds(Collection $collectionIds): self
    {
        $this->collectionIds = $collectionIds;

        return $this;
    }
}

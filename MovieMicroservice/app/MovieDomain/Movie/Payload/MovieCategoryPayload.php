<?php

namespace App\MovieDomain\Movie\Payload;

use Illuminate\Support\Collection;

class MovieCategoryPayload
{
    /**
     * @param int $userId
     * @param int $movieId
     * @param Collection<int> $categoryIds
     */
    private function __construct(
        private int $userId,
        private int $movieId,
        private Collection $categoryIds,
    ) {
    }

    /**
     * @param int $userId
     * @param int $movieId
     * @param Collection<int> $categoryIds
     * @return static
     */
    public static function make(
        int $userId,
        int $movieId,
        Collection $categoryIds,
    ): self {
        return new self(
            userId: $userId,
            movieId: $movieId,
            categoryIds: $categoryIds
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
     * @return Collection
     */
    public function getCategoryIds(): Collection
    {
        return $this->categoryIds;
    }
}

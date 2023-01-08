<?php

namespace App\MovieDomain\Movie\Filter;

use App\Common\Filter;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Support\Collection;

class MovieFilter extends Filter
{
    /**
     * @param int|null $userId
     * @param CollectionType|null $collectionType
     * @param Collection|null $categoryIds
     * @param Collection|null $collectionIds
     */
    private function __construct(
        private ?int $userId = null,
        private ?CollectionType $collectionType = null,
        private ?Collection $categoryIds = null,
        private ?Collection $collectionIds = null,
    ) {
    }

    /**
     * @param int|null $userId
     * @param CollectionType|null $collectionType
     * @param Collection<int>|null $categoryIds
     * @param Collection|null $collectionIds
     * @return self
     */
    public static function make(
        ?int $userId = null,
        ?CollectionType $collectionType = null,
        ?Collection $categoryIds = null,
        ?Collection $collectionIds = null,
    ): self {
        return new self(
            userId: $userId,
            collectionType: $collectionType,
            categoryIds: $categoryIds,
            collectionIds: $collectionIds,
        );
    }

    /**
     * @return Collection<int>|null
     */
    public function getCategoryIds(): ?Collection
    {
        return $this->categoryIds;
    }

    /**
     * @return Collection<int>|null
     */
    public function getCollectionIds(): ?Collection
    {
        return $this->collectionIds;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return CollectionType|null
     */
    public function getCollectionType(): ?CollectionType
    {
        return $this->collectionType;
    }
}

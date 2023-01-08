<?php

namespace App\MovieDomain\Collection\Filter;

use App\Common\Filter;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Support\Collection;

class CollectionFilter extends Filter
{
    /**
     * @param int|null $userId
     * @param CollectionType|null $type
     * @param Collection<int>|null $collectionIds
     */
    private function __construct(
        private ?int $userId = null,
        private ?CollectionType $type = null,
        private ?Collection $collectionIds = null,
    ) {
    }

    /**
     * @param int|null $userId
     * @param CollectionType|null $type
     * @param Collection<int>|null $collectionIds
     * @return static
     */
    public static function make(
        ?int $userId = null,
        ?CollectionType $type = null,
        ?Collection $collectionIds = null,
    ): self  {
        return new self(
            userId: $userId,
            type: $type,
            collectionIds: $collectionIds
        );
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
    public function getType(): ?CollectionType
    {
        return $this->type;
    }

    /**
     * @return Collection<int>|null
     */
    public function getCollectionIds(): ?Collection
    {
        return $this->collectionIds;
    }
}

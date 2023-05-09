<?php

namespace App\MovieDomain\Collection\Filter;

use App\Common\Filter;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Support\Collection;

class CollectionFilter extends Filter
{
    /**
     * @param int|null $userId
     * @param int|null $movieId
     * @param int|null $withoutUserId
     * @param CollectionType|null $type
     * @param Collection|null $types
     * @param Collection<int>|null $collectionIds
     */
    private function __construct(
        private ?int $userId = null,
        private ?int $movieId = null,
        private ?int $withoutUserId = null,
        private ?CollectionType $type = null,
        private ?Collection $types = null,
        private ?Collection $collectionIds = null,
    ) {
    }

    /**
     * @param int|null $userId
     * @param int|null $movieId
     * @param CollectionType|null $type
     * @param Collection|null $types
     * @param Collection<int>|null $collectionIds
     * @return static
     */
    public static function make(
        ?int $userId = null,
        ?int $movieId = null,
        ?int $withoutUserId = null,
        ?CollectionType $type = null,
        ?Collection $types = null,
        ?Collection $collectionIds = null,
    ): self  {
        return new self(
            userId: $userId,
            movieId: $movieId,
            withoutUserId: $withoutUserId,
            type: $type,
            types: $types,
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

    /**
     * @return int|null
     */
    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    /**
     * @param CollectionType|null $type
     * @return self
     */
    public function setType(?CollectionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param Collection|null $types
     * @return self
     */
    public function setTypes(?Collection $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getTypes(): ?Collection
    {
        return $this->types;
    }

    /**
     * @return int|null
     */
    public function getWithoutUserId(): ?int
    {
        return $this->withoutUserId;
    }

    /**
     * @return array
     */
    public function getTypesValuesArray(): array
    {
        if (empty($this->getTypes())) {
            return [];
        }

        return $this->getTypes()->map(fn (CollectionType $type) => $type->value)->toArray();
    }
}

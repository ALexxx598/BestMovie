<?php

namespace App\MovieDomain\Collection;


use Illuminate\Support\Collection as IlluminateCollection;

class Collection
{
    /**
     * @param int|null $id
     * @param int $userId
     * @param CollectionType $type
     * @param string $name
     * @param IlluminateCollection|null $movieIds
     */
    public function __construct(
        private ?int $id = null,
        private int $userId,
        private CollectionType $type,
        private string $name,
        private ?IlluminateCollection $movieIds = null,
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
     * @return CollectionType
     */
    public function getType(): CollectionType
    {
        return $this->type;
    }

    /**
     * @param CollectionType $type
     * @return self
     */
    public function setType(CollectionType $type): self
    {
        $this->type = $type;

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
     * @return IlluminateCollection|null
     */
    public function getMovieIds(): ?IlluminateCollection
    {
        return $this->movieIds;
    }

    /**
     * @param IlluminateCollection|null $movieIds
     * @return self
     */
    public function setMovieIds(?IlluminateCollection $movieIds = null): self
    {
        $this->movieIds = $movieIds;

        return $this;
    }
}

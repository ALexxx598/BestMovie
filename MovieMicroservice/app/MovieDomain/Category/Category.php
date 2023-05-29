<?php

namespace App\MovieDomain\Category;

use Illuminate\Support\Collection;

class Category
{
    /**
     * @param int|null $id
     * @param string $name
     * @param Collection|null $movieIds
     */
    public function __construct(
        private ?int $id = null,
        private string $name,
        private ?Collection $movieIds = null,
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
     * @return Collection|null
     */
    public function getMovieIds(): ?Collection
    {
        return $this->movieIds;
    }

    /**
     * @param Collection|null $movieIds
     * @return self
     */
    public function setMovieIds(?Collection $movieIds = null): self
    {
        $this->movieIds = $movieIds;

        return $this;
    }
}

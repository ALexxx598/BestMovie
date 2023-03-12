<?php

namespace App\MovieDomain\Category\Filter;

use App\Common\Filter;

class CategoryFilter extends Filter
{
    /**
     * @param array|null $categoryIds
     * @param string|null $name
     * @param int|null $movieId
     */
    private function __construct(
        private ?array $categoryIds = null,
        private ?string $name = null,
        private ?int $movieId = null,
    ) {
    }

    /**
     * @param array|null $categoryIds
     * @param string|null $name
     * @param int|null $movieId
     * @return static
     */
    public static function make(
        ?array $categoryIds = null,
        ?string $name = null,
        ?int $movieId = null,
    ): self {
       return new self(
           categoryIds: $categoryIds,
           name: $name,
           movieId: $movieId
       );
    }

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getMovieId(): ?int
    {
        return $this->movieId;
    }
}

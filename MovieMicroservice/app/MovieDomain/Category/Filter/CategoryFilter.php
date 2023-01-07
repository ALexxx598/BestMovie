<?php

namespace App\MovieDomain\Category\Filter;

use App\Common\Filter;

class CategoryFilter extends Filter
{
    /**
     * @param array|null $categoryIds
     * @param string|null $name
     */
    private function __construct(
        private ?array $categoryIds = null,
        private ?string $name = null,
    ) {
    }

    /**
     * @param array|null $categoryIds
     * @param string|null $name
     * @return static
     */
    public static function make(
        ?array $categoryIds = null,
        ?string $name = null,
    ): self {
       return new self(
           categoryIds: $categoryIds,
           name: $name
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
}

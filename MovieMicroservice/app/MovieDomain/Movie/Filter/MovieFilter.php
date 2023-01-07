<?php

namespace App\MovieDomain\Movie\Filter;

use App\Common\Filter;
use Illuminate\Support\Collection;

class MovieFilter extends Filter
{
    /**
     * @param Collection|null $categoryIds
     */
    private function __construct(
        private ?Collection $categoryIds = null,
    ) {
    }

    /**
     * @param Collection<int>|null $categoryIds
     * @return self
     */
    public static function make(
        ?Collection $categoryIds = null,
    ): self {
        return new self(
            categoryIds: $categoryIds
        );
    }

    /**
     * @return Collection|null
     */
    public function getCategoryIds(): ?Collection
    {
        return $this->categoryIds;
    }

    /**
     * @param Collection|null $categoryIds
     * @return self
     */
    public function setCategoryIds(?Collection $categoryIds): self
    {
        $this->categoryIds = $categoryIds;

        return $this;
    }
}

<?php

namespace App\MovieDomain\MovieCategory\Repository;

use App\Models\MovieCategory;

class MovieCategoryRepository implements MovieCategoryRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function deleteByCategoryId(int $categoryId): void
    {
        MovieCategory::query()->where('category_id', $categoryId)->delete();
    }
}

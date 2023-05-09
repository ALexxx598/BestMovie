<?php

namespace App\MovieDomain\Category\Repository;

use App\MovieDomain\Category\Category;
use App\MovieDomain\Category\CategoryCollection;
use App\MovieDomain\Category\Filter\CategoryFilter;

interface CategoryRepositoryInterface
{
    /**
     * @param Category $category
     * @return int
     */
    public function save(Category $category): int;

    /**
     * @param CategoryFilter $filter
     * @return CategoryCollection
     */
    public function list(CategoryFilter $filter): CategoryCollection;

    /**
     * @param int $categoryId
     * @return void
     */
    public function deleteById(int $categoryId): void;
}

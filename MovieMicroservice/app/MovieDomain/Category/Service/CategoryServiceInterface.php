<?php

namespace App\MovieDomain\Category\Service;

use App\MovieDomain\Category\Category;
use App\MovieDomain\Category\CategoryCollection;
use App\MovieDomain\Category\Filter\CategoryFilter;
use App\MovieDomain\Category\Payload\CategoryCreatePayload;

interface CategoryServiceInterface
{
    /**
     * @param CategoryCreatePayload $payload
     * @return Category
     */
    public function create(CategoryCreatePayload $payload): Category;

    /**
     * @param CategoryFilter $filter
     * @return CategoryCollection
     */
    public function list(CategoryFilter $filter): CategoryCollection;
}

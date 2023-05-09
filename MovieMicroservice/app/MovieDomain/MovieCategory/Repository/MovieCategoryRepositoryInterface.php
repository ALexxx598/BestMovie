<?php

namespace App\MovieDomain\MovieCategory\Repository;

interface MovieCategoryRepositoryInterface
{
    /**
     * @param int $categoryId
     */
    public function deleteByCategoryId(int $categoryId): void;
}

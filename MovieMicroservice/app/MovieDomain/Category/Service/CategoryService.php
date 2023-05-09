<?php

namespace App\MovieDomain\Category\Service;

use App\MovieDomain\Category\Category;
use App\MovieDomain\Category\CategoryCollection;
use App\MovieDomain\Category\Filter\CategoryFilter;
use App\MovieDomain\Category\Payload\CategoryCreatePayload;
use App\MovieDomain\Category\Repository\CategoryRepositoryInterface;
use App\MovieDomain\MovieCategory\Repository\MovieCategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private MovieCategoryRepositoryInterface $movieCategoryRepository,
    ) {
    }

    /**
     * @param CategoryFilter $filter
     * @return CategoryCollection
     */
    public function list(CategoryFilter $filter): CategoryCollection
    {
        return $this->categoryRepository->list($filter);
    }

    /**
     * @param CategoryCreatePayload $payload
     * @return Category
     */
    public function create(CategoryCreatePayload $payload): Category
    {
        $category = new Category(
            name: $payload->getName(),
        );

        return $category->setId($this->categoryRepository->save($category));
    }

    public function delete(int $categoryId): void
    {
        $this->movieCategoryRepository->deleteByCategoryId($categoryId);
        $this->categoryRepository->deleteById($categoryId);
    }
}

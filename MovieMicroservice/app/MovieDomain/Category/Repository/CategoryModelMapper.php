<?php

namespace App\MovieDomain\Category\Repository;

use App\Models\Category as CategoryModel;
use App\MovieDomain\Category\Category;
use Illuminate\Support\Collection;

class CategoryModelMapper
{
    /**
     * @param Category $category
     * @return CategoryModel
     */
    public function mapEntityToModel(Category $category): CategoryModel
    {
        $model = new CategoryModel();

        $model->name = $category->getName();

        if ($category->getId() !== null) {
            $model->id = $category->getId();
        }

        return $model;
    }

    /**
     * @param Collection<CategoryModel> $models
     * @return Collection<Category>
     */
    public function mapModelsToEntities(Collection $models): Collection
    {
        return $models->map(fn (CategoryModel $category): Category => $this->mapModelToEntity($category));
    }

    /**
     * @param CategoryModel $category
     * @return Category
     */
    public function mapModelToEntity(CategoryModel $category): Category
    {
        return new Category(
            id: $category->id,
            name: $category->name,
        );
    }
}

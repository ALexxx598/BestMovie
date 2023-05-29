<?php

namespace App\MovieDomain\Category\Repository;

use App\Models\Category as CategoryModel;
use App\Models\Movie;
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
     * @param CategoryModel $categoryModal
     * @return Category
     */
    public function mapModelToEntity(CategoryModel $categoryModal): Category
    {
        $category = new Category(
            id: $categoryModal->id,
            name: $categoryModal->name,
        );

        if ($categoryModal->relationLoaded('movies')) {
            $category->setMovieIds($this->mapMovieIds($categoryModal->movies));
        }

        return $category;
    }

    /**
     * @param \Illuminate\Support\Collection<Movie> $models
     * @return Collection<int>
     */
    private function mapMovieIds(Collection $moviesModels): Collection
    {
        return $moviesModels->map(fn (Movie $movie) => $movie->id);
    }
}

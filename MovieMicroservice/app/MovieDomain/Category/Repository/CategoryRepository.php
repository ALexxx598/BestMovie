<?php

namespace App\MovieDomain\Category\Repository;

use App\Models\Category as CategoryModel;
use App\MovieDomain\Category\Category;
use App\MovieDomain\Category\CategoryCollection;
use App\MovieDomain\Category\Filter\CategoryFilter;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param CategoryModelMapper $categoryModelMapper
     */
    public function __construct(
        private CategoryModelMapper $categoryModelMapper,
    ) {
    }

    public function list(CategoryFilter $filter): CategoryCollection
    {
        $query = CategoryModel::query();

        $query->with(['movies']);
        $this->applyToQuery($filter, $query);

        $paginator = $query->paginate(perPage: $filter->getPerPage(), page: $filter->getPage());

        return CategoryCollection::make($this->categoryModelMapper->mapModelsToEntities(collect($paginator->items())))
            ->setPerPage($paginator->perPage())
            ->setPage($paginator->currentPage())
            ->setTotal($paginator->total())
            ->setLastPage($paginator->lastPage());
    }

    /**
     * @param Category $category
     * @return int
     */
    public function save(Category $category): int
    {
        $model = $this->categoryModelMapper->mapEntityToModel($category);

        $model->exists = $model->id ?? false;
        $model->save();

        return $model->id;
    }

    /**
     * @param CategoryFilter $filter
     * @param Builder $query
     */
    private function applyToQuery(CategoryFilter $filter, Builder $query)
    {
        if ($filter->getMovieId() !== null) {
            $query->whereHas('movies',  function (Builder $query) use ($filter) {
               return $query->where('movie_id', $filter->getMovieId());
            });
        }

        if ($filter->getName() !== null) {
            $query->where('name', 'like', '%' . $filter->getName() . '%');
        }

        if ($filter->getCategoryIds() !== null) {
            $query->whereIn('id', $filter->getCategoryIds());
        }
    }
}

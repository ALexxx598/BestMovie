<?php

namespace App\MovieDomain\Collection\Repository;

use App\Models\Collection as CollectionModel;
use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;
use Illuminate\Database\Eloquent\Builder;

class CollectionRepository implements CollectionRepositoryInterface
{
    /**
     * @param CollectionModelMapper $collectionModelMapper
     */
    public function __construct(
        private CollectionModelMapper $collectionModelMapper,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function save(Collection $collection): int
    {
        $model = $this->collectionModelMapper->mapEntityToModel($collection);

        $model->exists = $model->id ?? false;
        $model->save();

        return $model->id;
    }

    /**
     * @inheritDoc
     */
    public function list(CollectionFilter $filter): MovieCollections
    {
        $query = CollectionModel::query();

        $query->with(['movies']);
        $this->applyToQuery($filter, $query);

        $paginator = $query->paginate(perPage: $filter->getPerPage(), page: $filter->getPage());

        return MovieCollections::make($this->collectionModelMapper->mapModelsToEntities(collect($paginator->items())))
            ->setPerPage($paginator->perPage())
            ->setPage($paginator->currentPage())
            ->setTotal($paginator->total())
            ->setLastPage($paginator->lastPage());
    }

    /**
     * @param CollectionFilter $filter
     * @param Builder $query
     */
    private function applyToQuery(CollectionFilter $filter, Builder $query)
    {
        if ($filter->getUserId() !== null) {
            $query->where('user_id', $filter->getUserId());
        }

        if ($filter->getType() !== null) {
            $query->where('type', $filter->getType()->value);
        }

        if ($filter->getTypes() !== null) {
            $query->whereIn('type', $filter->getTypesValuesArray());
        }

        if ($filter->getCollectionIds() !== null) {
            $query->whereIn('id',  $filter->getCollectionIds()->toArray());
        }

        if ($filter->getMovieId() !== null) {
            $query->whereHas('movies', function (Builder $query) use ($filter) {
                $query->where('movie_id', $filter->getMovieId());
            });
        }
    }
}

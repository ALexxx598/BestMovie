<?php

namespace App\MovieDomain\Movie\Repository;

use App\MovieDomain\Movie\Exception\MovieNotFound;
use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\Models\Movie as MovieModel;
use App\MovieDomain\Movie\MovieCollection;
use Illuminate\Database\Eloquent\Builder;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @param MoveModelMapper $moveModelMapper
     */
    public function __construct(
        private MoveModelMapper $moveModelMapper,
    ) {
    }

    /**
     * @inheritDoc
     * @throws MovieNotFound
     */
    public function findById(int $id): Movie
    {
        if (is_null($movie = MovieModel::find($id))) {
            throw new MovieNotFound();
        };

        return $this->moveModelMapper->mapModelToEntity($movie);
    }

    /**
     * @param MovieFilter $filter
     * @return MovieCollection
     */
    public function list(MovieFilter $filter): MovieCollection
    {
        $query = MovieModel::query();

        $query->with(['categories', 'collections']);
        $this->applyToQuery($filter, $query);

        $paginator = $query->paginate(perPage: $filter->getPerPage(), page: $filter->getPage());

        return MovieCollection::make($this->moveModelMapper->mapModelsToEntities(collect($paginator->items())))
            ->setPerPage($paginator->perPage())
            ->setPage($paginator->currentPage())
            ->setTotal($paginator->total())
            ->setLastPage($paginator->lastPage());
    }

    /**
     * @inheritDoc
     */
    public function save(Movie $movie): int
    {
        $model = $this->moveModelMapper->mapEntityToModel($movie);

        $model->exists = $model->id ?? false;
        $model->save();

        return $model->id;
    }

    /**
     * @param MovieFilter $filter
     * @param Builder $query
     */
    private function applyToQuery(MovieFilter $filter, Builder $query): void
    {
        if ($filter->getCategoryIds() !== null) {
            $query->whereHas('categories', function (Builder $query) use ($filter) {
                $query->whereIn('category_id', $filter->getCategoryIds()->toArray());
            });
        }

        if ($filter->getUserId() !== null) {
            $query->whereHas('collections', function (Builder $query) use ($filter) {
                $query->where('user_id', $filter->getUserId());
            });
        }

        if ($filter->getCollectionType() !== null) {
            $query->whereHas('collections', function (Builder $query) use ($filter) {
                $query->where('type', $filter->getCollectionType()->value);
            });
        }

        if ($filter->getCollectionIds() !== null) {
            $query->whereHas('collections', function (Builder $query) use ($filter) {
                $query->whereIn('collection_id', $filter->getCollectionIds()->toArray());
            });
        }
    }
}

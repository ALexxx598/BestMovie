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
     * @param MovieModelMapper $moveModelMapper
     */
    public function __construct(
        private MovieModelMapper $moveModelMapper,
    ) {
    }

    /**
     * @inheritDoc
     * @throws MovieNotFound
     */
    public function findById(int $id): Movie
    {
        return $this->moveModelMapper->mapModelToEntity($this->findModelById($id));
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

    /**
     * @param int $id
     * @return MovieModel
     * @throws MovieNotFound
     */
    private function findModelById(int $id): MovieModel
    {
        if (is_null($movie = MovieModel::find($id))) {
            throw new MovieNotFound();
        };

        return $movie;
    }

    /**
     * @param int $movieId
     * @param int[]|null $collectionIds
     * @throws MovieNotFound
     */
    public function syncCollections(int $movieId, ?array $collectionIds): void
    {
        $movie = $this->findModelById($movieId);

        if ($collectionIds !== null) {
            $movie->collections()->sync($collectionIds);
        }
    }

    public function delete(int $id): void
    {
        if (is_null($movie = MovieModel::find($id))) {
            throw new MovieNotFound();
        };

        $movie->delete();
    }

    /**
     * @param int $movieId
     * @param array|null $categoryIds
     * @throws MovieNotFound
     */
    public function syncCategories(int $movieId, ?array $categoryIds): void
    {
        $movie = $this->findModelById($movieId);

        if ($categoryIds !== null) {
            $movie->categories()->sync($categoryIds);
        }
    }
}

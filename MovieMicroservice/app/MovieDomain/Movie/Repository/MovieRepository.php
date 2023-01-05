<?php

namespace App\MovieDomain\Movie\Repository;

use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\Models\Movie as MovieModel;
use App\MovieDomain\Movie\MovieCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @param MovieFilter $filter
     * @return MovieCollection
     */
    public function list(MovieFilter $filter): MovieCollection
    {
        $query = MovieModel::query();

        $this->applyToQuery($filter, $query);

        $paginator = $query->paginate(perPage: $filter->getPerPage(), page: $filter->getPage());

        return MovieCollection::make($this->mapModelsToEntities(collect($paginator->items())))
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
        $model = $this->mapEntityToModel($movie);

        $model->exists = $model->id ?? false;
        $model->save();

        return $model->id;
    }

    /**
     * @param Movie $movie
     * @return MovieModel
     *
     * //TODO move to mapper
     */
    private function mapEntityToModel(Movie $movie): MovieModel
    {
        $movieModel = new MovieModel();

        $movieModel->name = $movie->getName();
        $movieModel->description = json_encode($movie->getDescription());
        $movieModel->storage_image_link = $movie->getStorageImageUrl();
        $movieModel->storage_movie_link = $movie->getStorageMovieUrl();

        if ($movie->getId() !== null) {
            $movieModel->id = $movie->getId();
        }

        return $movieModel;
    }

    /**
     * @param MovieModel $movie
     * @return Movie
     *
     * //TODO move to mapper
     */
    private function mapModelToEntity(MovieModel $movie): Movie
    {
        return new Movie(
            id: $movie->id,
            name: $movie->name,
            description: json_decode($movie->description, true),
            storageMovieUrl: $movie->storage_movie_link,
            storageImageUrl: $movie->storage_image_link
        );
    }

    /**
     * @param Collection $models
     * @return Collection
     */
    private function mapModelsToEntities(Collection $models): Collection
    {
        return $models->map(fn (MovieModel $model) => $this->mapModelToEntity($model));
    }

    /**
     * @param MovieFilter $filter
     * @param Builder $query
     */
    private function applyToQuery(MovieFilter $filter, Builder $query): void
    {
        // Todo add filters
    }
}

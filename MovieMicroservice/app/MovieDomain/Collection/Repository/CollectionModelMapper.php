<?php

namespace App\MovieDomain\Collection\Repository;

use App\Models\Collection as CollectionModel;
use App\Models\Movie;
use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Support\Collection as IlluminateCollection;

class CollectionModelMapper
{
    /**
     * @param Collection $collection
     * @return CollectionModel
     */
    public function mapEntityToModel(Collection $collection): CollectionModel
    {
        $model = new CollectionModel();

        $model->type = $collection->getType()->value;
        $model->name = $collection->getName();
        $model->user_id = $collection->getUserId();

        if ($collection->getId() !== null) {
            $model->id = $collection->getId();
        }

        return $model;
    }

    /**
     * @param CollectionModel $collectionModel
     * @return Collection
     */
    public function mapModelToEntity(CollectionModel $collectionModel): Collection
    {
        $collection = new Collection(
            id: $collectionModel->id,
            userId: $collectionModel->user_id,
            type: CollectionType::tryFrom($collectionModel->type),
            name: $collectionModel->name
        );

        if ($collectionModel->relationLoaded('movies')) {
            $collection->setMovieIds($this->mapMovieIds($collectionModel->movies));
        }

        return $collection;
    }

    /**
     * @param IlluminateCollection<CollectionModel> $models
     * @return IlluminateCollection<Collection>
     */
    public function mapModelsToEntities(IlluminateCollection $models): IlluminateCollection
    {
        return $models->map(
            fn (CollectionModel $movieCollection): Collection => $this->mapModelToEntity($movieCollection)
        );
    }

    /**
     * @param \Illuminate\Support\Collection<Movie> $models
     * @return IlluminateCollection<int>
     */
    private function mapMovieIds(IlluminateCollection $moviesModels): IlluminateCollection
    {
        return $moviesModels->map(fn (Movie $movie) => $movie->id);
    }
}

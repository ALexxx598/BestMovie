<?php

namespace App\MovieDomain\Collection\Repository;

use App\Models\Collection as CollectionModel;
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

    public function mapModelToEntity(CollectionModel $collection): Collection
    {
        return new Collection(
            id: $collection->id,
            userId: $collection->user_id,
            type: CollectionType::tryFrom($collection->type),
            name: $collection->name
        );
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
}

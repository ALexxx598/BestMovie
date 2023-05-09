<?php

namespace App\MovieDomain\MovieCollection\Repository;

use App\Models\MovieCollection;

class MovieCollectionRepository implements MovieCollectionRepositoryInterface
{
    /**
     * @param int $collectionId
     */
    public function deleteByCollectionId(int $collectionId): void
    {
        MovieCollection::query()->where('collection_id', $collectionId)->delete();
    }
}

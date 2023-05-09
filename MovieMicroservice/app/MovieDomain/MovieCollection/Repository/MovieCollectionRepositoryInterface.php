<?php

namespace App\MovieDomain\MovieCollection\Repository;

interface MovieCollectionRepositoryInterface
{
    /**
     * @param int $collectionId
     */
    public function deleteByCollectionId(int $collectionId): void;
}

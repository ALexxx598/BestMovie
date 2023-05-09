<?php

namespace App\MovieDomain\Collection\Repository;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\Exception\CollectionNotFound;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;

interface CollectionRepositoryInterface
{
    /**
     * @param Collection $collection
     * @return int
     */
    public function save(Collection $collection): int;

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     */
    public function list(CollectionFilter $filter): MovieCollections;

    /**
     * @param int $id
     * @return Collection
     * @throws CollectionNotFound
     */
    public function findById(int $id): Collection;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}

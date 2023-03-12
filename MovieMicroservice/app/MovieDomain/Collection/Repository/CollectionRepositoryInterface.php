<?php

namespace App\MovieDomain\Collection\Repository;

use App\MovieDomain\Collection\Collection;
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
}

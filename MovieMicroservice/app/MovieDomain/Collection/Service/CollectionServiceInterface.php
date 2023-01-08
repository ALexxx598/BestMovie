<?php

namespace App\MovieDomain\Collection\Service;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;

interface CollectionServiceInterface
{
    /**
     * @param CollectionCreatePayload $payload
     * @return Collection
     */
    public function create(CollectionCreatePayload $payload): Collection;

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     */
    public function list(CollectionFilter $filter): MovieCollections;
}

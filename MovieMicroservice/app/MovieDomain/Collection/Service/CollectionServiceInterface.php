<?php

namespace App\MovieDomain\Collection\Service;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;

interface CollectionServiceInterface
{
    /**
     * @param int $id
     * @return Collection
     * @throws \App\MovieDomain\Collection\Exception\CollectionNotFound
     */
    public function findById(int $id): Collection;

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

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     */
    public function listOfDefaults(CollectionFilter $filter): MovieCollections;

    /**
     * @param int $userId
     * @param int $collectionId
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     * @throws \App\MovieDomain\Collection\Exception\CollectionNotFound
     */
    public function deleteWithPermissionCheck(int $userId, int $collectionId): void;

    /**
     * @param int $collectionId
     */
    public function delete(int $collectionId): void;
}

<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\Payload\MovieCollectionPayload;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\MovieCollection;

interface MovieServiceInterface
{
    /**
     * @param MovieCreatePayload $payload
     * @return mixed
     */
    public function create(MovieCreatePayload $payload);

    /**
     * @param MovieFilter $filter
     * @return MovieCollection
     */
    public function list(MovieFilter $filter): MovieCollection;

    /**
     * @param int $id
     * @return Movie
     */
    public function findById(int $id): Movie;

    /**
     * @param MovieCollectionPayload $payload
     */
    public function syncCollections(MovieCollectionPayload $payload): void;
}

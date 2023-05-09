<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Exception\InvalidImageUrl;
use App\MovieDomain\Movie\Exception\InvalidMovieUrl;
use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\Payload\MovieCollectionPayload;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\MovieCollection;

interface MovieServiceInterface
{
    /**
     * @param MovieCreatePayload $payload
     * @throws InvalidMovieUrl
     * @throws InvalidImageUrl
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return Movie
     */
    public function create(MovieCreatePayload $payload): Movie;

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
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function syncCollections(MovieCollectionPayload $payload): void;

    /**
     * @param MovieCollectionPayload $payload
     */
    public function syncDefaultCollections(MovieCollectionPayload $payload): void;
}

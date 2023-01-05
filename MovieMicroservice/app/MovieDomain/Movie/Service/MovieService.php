<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\MovieCollection;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;

class MovieService implements MovieServiceInterface
{
    public function __construct(
        private MovieRepositoryInterface $movieRepository
    ) {
    }

    /**
     * @inheritDoc
     */
    public function list(MovieFilter $filter): MovieCollection
    {
        return $this->movieRepository->list($filter);
    }

    /**
     * @inheritDoc
     */
    public function create(MovieCreatePayload $payload): Movie
    {
        //TODO  Validate links on MediaStorageMS

        $movie = new Movie(
            name: $payload->getName(),
            description: $payload->getDescription(),
            storageMovieUrl: $payload->getStorageMovieUrl(),
            storageImageUrl: $payload->getStorageImageUrl()
        );

        return $movie->setId($this->movieRepository->save($movie));
    }
}

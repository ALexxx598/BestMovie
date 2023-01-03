<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;

class MovieService implements MovieServiceInterface
{
    public function __construct(
        private MovieRepositoryInterface $movieRepository
    ) {
    }

    public function create(MovieCreatePayload $payload)
    {
        $movie = new Movie(
            name: $payload->getName(),
            description: $payload->getDescription(),
            storageMovieUrl: $payload->getStorageMovieUrl(),
            storageImageUrl: $payload->getStorageImageUrl()
        );

        $this->movieRepository->save($movie);
    }
}

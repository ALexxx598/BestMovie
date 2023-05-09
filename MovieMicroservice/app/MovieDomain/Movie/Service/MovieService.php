<?php

namespace App\MovieDomain\Movie\Service;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\CollectionType;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\Service\CollectionServiceInterface;
use App\MovieDomain\Movie\Exception\InvalidImageUrl;
use App\MovieDomain\Movie\Exception\InvalidMovieUrl;
use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Movie;
use App\MovieDomain\Movie\MovieCollection;
use App\MovieDomain\Movie\MovieDescription;
use App\MovieDomain\Movie\Payload\MovieCollectionPayload;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\Repository\MovieRepositoryInterface;
use App\MovieDomain\User\Service\UserServiceInterface;
use BestMovie\Common\BestMovieStorage\Service\BestMovieStorageServiceInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class MovieService implements MovieServiceInterface
{
    /**
     * @param MovieRepositoryInterface $movieRepository
     * @param UserServiceInterface $userService
     * @param CollectionServiceInterface $collectionService
     */
    public function __construct(
        private MovieRepositoryInterface $movieRepository,
        private UserServiceInterface $userService,
        private CollectionServiceInterface $collectionService,
        private BestMovieStorageServiceInterface $bestMovieStorageService,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Movie
    {
        return $this->movieRepository->findById($id);
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
        if (!$this->bestMovieStorageService->validatePath($payload->getStorageMovieUrl())) {
            throw new InvalidMovieUrl();
        }

        if (!$this->bestMovieStorageService->validatePath($payload->getStorageImageUrl())) {
            throw new InvalidImageUrl();
        };

        $movie = new Movie(
            name: $payload->getName(),
            description: new MovieDescription(
                rating: $payload->getDescriptionRating(),
                slogan: $payload->getDescriptionSlogan(),
                screeningDate: $payload->getDescriptionScreeningDate(),
                country: $payload->getDescriptionCountry(),
                actors: $payload->getDescriptionActors(),
                shortDescription: $payload->getShortDescription()
            ),
            storageMovieUrl: $payload->getStorageMovieUrl(),
            storageImageUrl: $payload->getStorageImageUrl()
        );

        return $movie->setId($this->movieRepository->save($movie));
    }

    /**
     * @inheritDoc
     */
    public function syncCollections(MovieCollectionPayload $payload): void
    {
        $user = $this->userService->findUser($payload->getUserId());

        $movie = $this->movieRepository->findById($payload->getMovieId());

        $collectionIds = $this
            ->collectionService
            ->list(
                CollectionFilter::make(
                    userId: $user->getId(),
                    type: CollectionType::CUSTOM(),
                    collectionIds: $payload->getCollectionIds()
                )
            )
            ->map(fn (Collection $collection) => $collection->getId())
            ->toArray();

        $defaultCollectionIds = $this->collectionService
            ->list(
                CollectionFilter::make(
                    movieId: $movie->getId(),
                    withoutUserId: $user->getId(),
                ),
            )
            ->map(fn (Collection $collection): int => $collection->getId())
            ->toArray();

        $collectionIds = array_merge($collectionIds, $defaultCollectionIds);

        $this->movieRepository->syncCollections($movie->getId(), $collectionIds);
    }

    /**
     * @inheritDoc
     */
    public function syncDefaultCollections(MovieCollectionPayload $payload): void
    {
        $movie = $this->movieRepository->findById($payload->getMovieId());

        $collectionIds = $this
            ->collectionService
            ->list(
                CollectionFilter::make(
                    type: CollectionType::DEFAULT(),
                    collectionIds: $payload->getCollectionIds()
                )
            )
            ->map(fn (Collection $collection) => $collection->getId())
            ->toArray();

        $customCollectionIds = $this->collectionService
            ->list(CollectionFilter::make(movieId: $movie->getId(), type: CollectionType::CUSTOM()))
            ->map(fn (Collection $collection): int => $collection->getId())
            ->toArray();

        $collectionIds = array_merge($collectionIds, $customCollectionIds);

        $this->movieRepository->syncCollections($movie->getId(), $collectionIds);
    }
}

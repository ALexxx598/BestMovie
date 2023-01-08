<?php

namespace App\MovieDomain\Collection\Service;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\CollectionType;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\User\Service\UserServiceInterface;

class CollectionService implements CollectionServiceInterface
{
    /**
     * @param UserServiceInterface $userService
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(
        private UserServiceInterface $userService,
        private CollectionRepositoryInterface $collectionRepository,
    ) {
    }

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     */
    public function list(CollectionFilter $filter): MovieCollections
    {
        return $this->collectionRepository->list($filter);
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function create(CollectionCreatePayload $payload): Collection
    {
        $user = $this->userService->getUser($payload->getUserId());

        $type = match (true) {
            $user->isAdmin() && $user->isViewer() => CollectionType::TEST(),
            $user->isAdmin() => CollectionType::DEFAULT(),
            $user->isViewer() => CollectionType::CUSTOM(),
            default => CollectionType::TEST(),
        };

        $collection = new Collection(
            userId: $payload->getUserId(),
            type: $type,
            name: $payload->getName()
        );

        return $collection->setId($this->collectionRepository->save($collection));
    }
}

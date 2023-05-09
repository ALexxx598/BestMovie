<?php

namespace App\MovieDomain\Collection\Service;

use App\MovieDomain\Collection\Collection;
use App\MovieDomain\Collection\CollectionType;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\MovieCollections;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;
use App\MovieDomain\Collection\Repository\CollectionRepositoryInterface;
use App\MovieDomain\MovieCollection\Repository\MovieCollectionRepositoryInterface;
use App\MovieDomain\User\Service\UserServiceInterface;

class CollectionService implements CollectionServiceInterface
{
    /**
     * @param UserServiceInterface $userService
     * @param CollectionRepositoryInterface $collectionRepository
     * @param MovieCollectionRepositoryInterface $movieCollectionRepository
     */
    public function __construct(
        private UserServiceInterface $userService,
        private CollectionRepositoryInterface $collectionRepository,
        private MovieCollectionRepositoryInterface $movieCollectionRepository,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): Collection
    {
        return $this->collectionRepository->findById($id);
    }

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function list(CollectionFilter $filter): MovieCollections
    {
        return $this->collectionRepository->list($filter);
    }

    /**
     * @param CollectionFilter $filter
     * @return MovieCollections
     */
    public function listOfDefaults(CollectionFilter $filter): MovieCollections
    {
        $filter->setType(CollectionType::DEFAULT());

        return $this->collectionRepository->list($filter);
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function create(CollectionCreatePayload $payload): Collection
    {
        $user = $this->userService->findUser($payload->getUserId());

        $type = match (true) {
//            $user->isAdmin() && $user->isViewer() => CollectionType::TEST(),
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

    /**
     * @inheritDoc
     */
    public function deleteWithPermissionCheck(int $userId, int $collectionId): void
    {
        $user = $this->userService->findUser($userId);
        $collection = $this->findById($collectionId);

        if ($user->isAdmin() && $collection->isDefault()) {
            $this->delete($collectionId);
        }

        if ($user->isViewer() && $collection->isCustom() && $collection->isBelongToUser($user->getId())) {
            $this->delete($collectionId);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(int $collectionId): void
    {
        $this->movieCollectionRepository->deleteByCollectionId($collectionId);
        $this->collectionRepository->delete($collectionId);
    }
}

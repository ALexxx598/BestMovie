<?php

namespace App\Http\Controllers;

use App\Common\MovieMicroserviceRequest;
use App\Http\Request\Collection\CollectionCreateRequest;
use App\Http\Request\Collection\CollectionListRequest;
use App\Http\Request\Collection\CollectionRemoveRequest;
use App\Http\Resource\Collection\CollectionListResource;
use App\Http\Resource\Collection\CollectionResource;
use App\MovieDomain\Collection\CollectionType;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;
use App\MovieDomain\Collection\Service\CollectionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CollectionController
{
    /**
     * @param CollectionServiceInterface $collectionService
     */
    public function __construct(
        private CollectionServiceInterface $collectionService,
    ) {
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function list(CollectionListRequest $request): JsonResponse
    {
        $filter =
            CollectionFilter::make(
                userId: $request->getUserId(),
                type: CollectionType::tryFrom($request->getType()),
                collectionIds: $request->getCollectionIds() !== null
                    ? collect($request->getCollectionIds())
                    : null
            )
            ->setPage($request->getPage())
            ->setPerPage($request->getPerPage());

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CollectionListResource::make($this->collectionService->list($filter)),
        ], Response::HTTP_OK);
    }

    /**
     * @param MovieMicroserviceRequest $request
     * @return JsonResponse
     */
    public function listOfDefaults(MovieMicroserviceRequest $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CollectionListResource::make(
                $this->collectionService->listOfDefaults(CollectionFilter::make())
            )
        ], Response::HTTP_OK);
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function create(CollectionCreateRequest $request): JsonResponse
    {
        $payload = CollectionCreatePayload::make(
            userId: $request->getUserId(),
            name: $request->getName()
        );

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CollectionResource::make($this->collectionService->create($payload)),
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     * @throws \App\MovieDomain\Collection\Exception\CollectionNotFound
     */
    public function delete(CollectionRemoveRequest $request, int $collectionId): JsonResponse
    {
        $this->collectionService->deleteWithPermissionCheck($request->getUserId(), $collectionId);

        return response()->json([
            'status' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
}

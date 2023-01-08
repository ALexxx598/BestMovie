<?php

namespace App\Http\Controllers;

use App\Http\Request\Collection\CollectionCreateRequest;
use App\Http\Request\Collection\CollectionListRequest;
use App\Http\Resource\Collection\CollectionListResource;
use App\Http\Resource\Collection\CollectionResource;
use App\MovieDomain\Collection\CollectionType;
use App\MovieDomain\Collection\Filter\CollectionFilter;
use App\MovieDomain\Collection\Payload\CollectionCreatePayload;
use App\MovieDomain\Collection\Service\CollectionServiceInterface;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CollectionController
{
    /**
     * @param CollectionServiceInterface $collectionService
     * @param UserTokenServiceInterface $userTokenService
     */
    public function __construct(
        private CollectionServiceInterface $collectionService,
        private UserTokenServiceInterface $userTokenService,
    ) {
    }

    /**
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function list(CollectionListRequest $request): JsonResponse
    {
        if ($request->getUserId() !== null && $request->getAuthHeader() == null) {
            throw new AccessDeniedException('You must be authorized !!!');
        }

        $filter = CollectionFilter::make(
                userId: $request->getUserId() !== null
                    ? $this->userTokenService->getUserByToken($request->getAuthHeader())->getId()
                    : null,
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
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function create(CollectionCreateRequest $request): JsonResponse
    {
        $payload = CollectionCreatePayload::make(
            userId: $this->userTokenService->getUserByToken($request->getAuthHeader())->getId(),
            name: $request->getName()
        );

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CollectionResource::make($this->collectionService->create($payload)),
        ], Response::HTTP_CREATED);
    }
}

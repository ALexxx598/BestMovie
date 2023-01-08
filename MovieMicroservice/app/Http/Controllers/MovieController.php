<?php

namespace App\Http\Controllers;

use App\Common\MovieMicroserviceRequest;
use App\Http\Request\Movie\MovieListRequest;
use App\Http\Request\Movie\MovieCreateRequest;
use App\Http\Resource\Movie\MovieListResource;
use App\Http\Resource\Movie\MovieResource;
use App\MovieDomain\Movie\Filter\MovieFilter;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\Service\MovieServiceInterface;
use App\MovieDomain\User\Token\UserTokenServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class MovieController extends Controller
{
    /**
     * @param MovieServiceInterface $movieService
     * @param UserTokenServiceInterface $userTokenService
     */
    public function __construct(
        private MovieServiceInterface $movieService,
        private UserTokenServiceInterface $userTokenService,
    ) {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => MovieResource::make($this->movieService->findById(1))
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @param MovieListRequest $request
     * @return JsonResponse
     * @throws \App\MovieDomain\User\Exception\UserNotFoundException
     */
    public function list(MovieListRequest $request): JsonResponse
    {
        if ($request->getUserId() !== null && $request->getAuthHeader() == null) {
            throw new AccessDeniedException('You must be authorized !!!');
        }

        $filter = MovieFilter::make(
                userId: $request->getUserId() !== null
                    ? $this->userTokenService->getUserByToken($request->getAuthHeader())->getId()
                    : null,
                categoryIds: $request->getCategoryIds() !== null ? collect($request->getCategoryIds()) : null,
                collectionIds: $request->getCollectionIds() !== null
                    ? collect($request->getCollectionIds())
                    : null
            )
            ->setPage($request->getPage())
            ->setPerPage($request->getPerPage());

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => MovieListResource::make($this->movieService->list($filter))
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @param MovieCreateRequest $request
     * @return JsonResponse
     */
    public function create(MovieCreateRequest $request): JsonResponse
    {
        $payload = MovieCreatePayload::make(
            name: $request->getName(),
            description: $request->getDescription(),
            storageMovieUrl: $request->getStorageMovieLink(),
            storageImageUrl: $request->getStorageImageLink()
        );

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => MovieResource::make($this->movieService->create($payload))
        ], JsonResponse::HTTP_CREATED);
    }
}

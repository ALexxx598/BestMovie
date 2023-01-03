<?php

namespace App\Http\Controllers;

use App\Http\Request\Movie\MovieCreateRequest;
use App\Http\Resource\Movie\MovieResource;
use App\MovieDomain\Movie\Payload\MovieCreatePayload;
use App\MovieDomain\Movie\Service\MovieServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * @param MovieServiceInterface $movieService
     */
    public function __construct(
        private MovieServiceInterface $movieService
    ) {
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

<?php

namespace App\Exceptions;

use App\Common\CanNotDeleteException;
use App\Common\NotFoundException;
use App\Exceptions\ErrorCodes;
use App\MovieDomain\Movie\Exception\InvalidImageUrl;
use App\MovieDomain\Movie\Exception\InvalidMovieUrl;
use App\MovieDomain\User\Exception\NonValidPasswordException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    public function render($request, Throwable $e): JsonResponse
    {
        return match (true) {
            $e instanceof NonValidPasswordException => $this->mapNonValidPasswordException($e),
            $e instanceof NotFoundException => $this->mapNotFoundException($e),
            $e instanceof CanNotDeleteException => $this->mapCanNotDeleteException($e),
            $e instanceof InvalidMovieUrl => $this->mapInvalidMovieUrl($e),
            $e instanceof InvalidImageUrl => $this->mapInvalidImageUrl($e),
            default => parent::render($request, $e),
        };
    }

    /**
     * @param Exception|Throwable $e
     * @return JsonResponse
     */
    private function mapByDefault(Exception|Throwable $e): JsonResponse
    {
        return response()->json(
            [
                'message' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    /**
     * @param NonValidPasswordException $e
     * @return JsonResponse
     */
    private function mapNonValidPasswordException(NonValidPasswordException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::non_valid_password()->value,
            'error_code' => ErrorCodes::NON_VALID_PASSWORD,
        ], Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @param NotFoundException $e
     * @return JsonResponse
     */
    private function mapNotFoundException(NotFoundException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::not_found()->value,
            'error_code' => ErrorCodes::NOT_FOUND,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param CanNotDeleteException $e
     * @return JsonResponse
     */
    private function mapCanNotDeleteException(CanNotDeleteException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::can_not_remove_model()->value,
            'error_code' => ErrorCodes::CAN_NOT_REMOVE_MODEL,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param InvalidMovieUrl $e
     * @return JsonResponse
     */
    private function mapInvalidMovieUrl(InvalidMovieUrl $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::invalid_movie_url()->value,
            'error_code' => ErrorCodes::INVALID_MOVIE_URL,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param InvalidImageUrl $e
     * @return JsonResponse
     */
    private function mapInvalidImageUrl(InvalidImageUrl $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error' => ErrorCodes::invalid_image_url()->value,
            'error_code' => ErrorCodes::INVALID_IMAGE_URL,
        ], Response::HTTP_BAD_REQUEST);
    }
}

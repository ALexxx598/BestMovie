<?php

namespace App\Exceptions;

use App\Common\CanNotDeleteException;
use App\Common\ErrorCodes;
use App\Common\NotFoundException;
use App\MovieDomain\User\Exception\NonValidPasswordException;
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
        if ($e instanceof NonValidPasswordException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error_code' => ErrorCodes::non_valid_password()->value,
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        if ($e instanceof NotFoundException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error_code' => ErrorCodes::not_found()->value,
            ], Response::HTTP_BAD_REQUEST);
        }
        if ($e instanceof CanNotDeleteException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error_code' => ErrorCodes::can_not_remove_model()->value,
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(
            [
                'message' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}

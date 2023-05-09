<?php

namespace App\Http\Controllers;

use App\Http\Request\Category\CategoryCreateRequest;
use App\Http\Request\Category\CategoryListRequest;
use App\Http\Request\Category\CategoryRemoveRequest;
use App\Http\Resource\Category\CategoryListResource;
use App\Http\Resource\Category\CategoryResource;
use App\MovieDomain\Category\Filter\CategoryFilter;
use App\MovieDomain\Category\Payload\CategoryCreatePayload;
use App\MovieDomain\Category\Service\CategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(
        private CategoryServiceInterface $categoryService,
    ) {
    }

    /**
     * @param CategoryListRequest $request
     * @return JsonResponse
     */
    public function list(CategoryListRequest $request): JsonResponse
    {
        $filter = CategoryFilter::make(
                categoryIds: $request->getCategoryIds(),
                name: $request->getName()
            )
            ->setPerPage($request->getPerPage())
            ->setPage($request->getPage());

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CategoryListResource::make($this->categoryService->list($filter))
        ], Response::HTTP_OK);
    }

    /**
     * @param CategoryCreateRequest $request
     * @return JsonResponse
     */
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        $payload = CategoryCreatePayload::make(
            $request->getName(),
        );

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => CategoryResource::make($this->categoryService->create($payload))

        ], Response::HTTP_CREATED);
    }

    /**
     * @param CategoryRemoveRequest $request
     * @param int $categoryId
     * @return JsonResponse
     */
    public function delete(CategoryRemoveRequest $request, int $categoryId): JsonResponse
    {
        $this->categoryService->delete($categoryId);

        return response()->json([
            'status' => Response::HTTP_OK,
        ], Response::HTTP_CREATED);
    }
}

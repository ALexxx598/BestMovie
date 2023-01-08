<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;
use App\MovieDomain\Collection\CollectionType;
use Illuminate\Validation\Rule;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class MovieListRequest extends MovieMicroserviceRequest
{
    protected const PER_PAGE = 10;
    protected const PAGE = 1;

    public function rules(): array
    {
        return [
            'user_id' => [
                'nullable',
                'int',
            ],
            'category_ids' => [
                'nullable',
                'array'
            ],
            'category_ids.*' => [
                'int',
            ],
            'collection_ids' => [
                'nullable',
                'array',
            ],
            'collection_ids.*' => [
                'int',
            ],
            'per_page' => [
                'nullable',
                'int',
            ],
            'page' => [
                'nullable',
                'int',
            ],
        ];
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->input('user_id');
    }

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->input('category_ids');
    }

    /**
     * @return array|null
     */
    public function getCollectionIds(): ?array
    {
        return $this->input('collection_ids');
    }

    /**
     * @return string|null
     */
    public function getCollectionType(): ?string
    {
        return $this->input('collection_type');
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->input('page', self::PAGE);
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->input('per_page', self::PER_PAGE);
    }
}

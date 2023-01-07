<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;

class MovieListRequest extends MovieMicroserviceRequest
{
    protected const PER_PAGE = 10;
    protected const PAGE = 1;

    public function rules(): array
    {
        return [
            'per_page' => [
                'nullable',
                'int',
            ],
            'page' => [
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
        ];
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

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->input('category_ids');
    }
}

<?php

namespace App\Http\Request\Category;

use App\Common\MovieMicroserviceRequest;

class CategoryListRequest extends MovieMicroserviceRequest
{
    protected const PER_PAGE = 100;
    protected const PAGE = 1;

    public function rules(): array
    {
        return [
            'category_ids' => [
                'array'
            ],
            'category_ids.*' => [
                'int'
            ],
            'name' => [
                'string'
            ],
            'per_page' => [
                'int',
            ],
            'page' => [
                'int',
            ],
        ];
    }

    /**
     * @return array|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->input('category_ids');
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->input('name');
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

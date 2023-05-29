<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;
use Illuminate\Support\Collection;

class MovieCategoriesRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'int',
            ],
            'category_ids' => [
                'nullable',
                'array',
            ],
            'category_ids.*' => [
                'int',
            ],
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    /**
     * @return Collection<int>
     */
    public function getCategoryIds(): Collection
    {
        return collect($this->input('category_ids', []));
    }
}

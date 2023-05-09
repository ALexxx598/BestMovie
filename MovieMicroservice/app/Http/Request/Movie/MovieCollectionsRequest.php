<?php

namespace App\Http\Request\Movie;

use App\Common\MovieMicroserviceRequest;
use Illuminate\Support\Collection;

class MovieCollectionsRequest extends MovieMicroserviceRequest
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
            'collection_ids' => [
                'nullable',
                'array',
            ],
            'collection_ids.*' => [
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
    public function getCollectionIds(): Collection
    {
        return collect($this->input('collection_ids', []));
    }
}

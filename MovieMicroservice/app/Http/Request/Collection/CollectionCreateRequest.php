<?php

namespace App\Http\Request\Collection;

use App\Common\MovieMicroserviceRequest;

class CollectionCreateRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'int'
            ],
            'name' => [
                'required',
                'string',
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
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }
}

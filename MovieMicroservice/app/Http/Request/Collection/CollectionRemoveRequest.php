<?php

namespace App\Http\Request\Collection;

use App\Common\MovieMicroserviceRequest;

class CollectionRemoveRequest extends MovieMicroserviceRequest
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
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->input('user_id');
    }
}

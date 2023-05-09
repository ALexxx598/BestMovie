<?php

namespace App\Http\Request\Category;

use App\Common\MovieMicroserviceRequest;

class CategoryRemoveRequest extends MovieMicroserviceRequest
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

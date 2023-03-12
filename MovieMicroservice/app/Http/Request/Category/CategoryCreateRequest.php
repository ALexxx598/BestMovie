<?php

namespace App\Http\Request\Category;

use App\Common\MovieMicroserviceRequest;

class CategoryCreateRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ]
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }
}

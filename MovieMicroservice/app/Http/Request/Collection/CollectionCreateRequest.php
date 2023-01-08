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
            'name' => [
                'required',
                'string',
            ],
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

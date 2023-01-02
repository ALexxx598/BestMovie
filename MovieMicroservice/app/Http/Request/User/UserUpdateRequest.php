<?php

namespace App\Http\Requests\User;

use App\Common\MovieMicroserviceRequest;

class UserUpdateRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'name' => [
                'string',
            ],
            'surname' => [
                'string',
            ],
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->get('name');
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->get('surname');
    }
}

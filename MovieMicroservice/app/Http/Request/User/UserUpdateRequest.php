<?php

namespace App\Http\Request\User;

use App\Common\MovieMicroserviceRequest;

class UserUpdateRequest extends MovieMicroserviceRequest
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
            'name' => [
                'string',
            ],
            'surname' => [
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

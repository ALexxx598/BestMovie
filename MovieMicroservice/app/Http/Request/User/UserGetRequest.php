<?php

namespace App\Http\Request\User;

use App\Common\MovieMicroserviceRequest;

class UserGetRequest extends MovieMicroserviceRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'password' => [
                'required',
                'string',
                'min:10',
//                'regex:/[a-z]/',
//                'regex:/[A-Z]/',
//                'regex:/[0-9]/',
            ],
            'email' => [
                'required',
                'email',
            ]
        ];
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->get('password');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get('email');
    }
}

<?php

namespace App\Http\Request\User;

use App\Common\MovieMicroserviceRequest;
use Illuminate\Validation\Rule;

class UserPreRegisterRequest extends MovieMicroserviceRequest
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
                'min:3',
            ],
            'surname' => [
                'required',
                'string',
                'min:3',
            ],
            'password' => [
                'required',
                'string',
                'min:10',
//                'regex:/[a-z]/',
//                'regex:/[A-Z]/',
//                'regex:/[0-9]/',
            ],
            'password_confirmation' => [
                'required',
                'same:password',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users'),
            ]
        ];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }
}

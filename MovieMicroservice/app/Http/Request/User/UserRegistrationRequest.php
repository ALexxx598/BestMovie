<?php

namespace App\Http\Request\User;

use App\Common\MovieMicroserviceRequest;
use Illuminate\Validation\Rule;

class UserRegistrationRequest extends MovieMicroserviceRequest
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
            ],
            'email_confirmation_code' => [
                'required',
                'string',
                'max:255'
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

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->input('surname');
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->input('password');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return string
     */
    public function getEmailConfirmationCode(): string
    {
        return $this->input('email_confirmation_code');
    }
}

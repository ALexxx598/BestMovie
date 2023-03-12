<?php

namespace App\Http\Request\User;

use App\Common\MovieMicroserviceRequest;

class UserRequest extends MovieMicroserviceRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'int',
            ]
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

<?php

namespace App\Common;

use Illuminate\Foundation\Http\FormRequest;

class MovieMicroserviceRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getAuthHeader(): string
    {
        return $this->header('authorization');
    }
}

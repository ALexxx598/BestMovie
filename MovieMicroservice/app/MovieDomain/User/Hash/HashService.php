<?php

namespace App\MovieDomain\User\Hash;

use Illuminate\Support\Facades\Hash;

class HashService implements HashServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function makeHash(string $password): string
    {
        return Hash::make($password);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function check(string $password, string $hash): bool
    {
        return Hash::check($password, $hash);
    }
}

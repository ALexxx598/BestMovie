<?php

namespace App\MovieDomain\User\Hash;

interface HashServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function makeHash(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function check(string $password, string $hash): bool;
}

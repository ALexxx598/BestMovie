<?php

namespace App\MovieDomain\User\Exception;

use Exception;

class NonValidPasswordException extends Exception
{
    protected $message = 'Non valid password';
}

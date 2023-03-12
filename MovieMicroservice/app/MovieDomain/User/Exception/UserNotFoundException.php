<?php

namespace App\MovieDomain\User\Exception;

use App\Common\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    protected $message = 'Not found user';
}

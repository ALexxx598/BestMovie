<?php

namespace App\MovieDomain\Movie\Exception;

use Exception;

class InvalidMovieUrl extends Exception
{
    protected $message = 'Invalid movie url';
}

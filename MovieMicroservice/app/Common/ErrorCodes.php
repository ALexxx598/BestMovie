<?php

namespace App\Common;

use Spatie\Enum\Enum;

/**
 * @method static self NON_VALID_PASSWORD()
 * @method static self NOT_FOUND()
 * @method static self CAN_NOT_REMOVE_MODEL()
 */
class ErrorCodes extends Enum
{
    protected const NON_VALID_PASSWORD = '1010';
    protected const NOT_FOUND = '1011';
    protected const CAN_NOT_REMOVE_MODEL = '1012';
}

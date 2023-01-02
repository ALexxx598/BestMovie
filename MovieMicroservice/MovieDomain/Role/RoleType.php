<?php

namespace App\MovieDomain\Role;

use Spatie\Enum\Enum;

/**
 * @method static self VIEWER()
 * @method static self ADMIN()
 */
class RoleType extends Enum
{
    protected const VIEWER = 'VIEWER';
    protected const ADMIN = 'ADMIN';
}

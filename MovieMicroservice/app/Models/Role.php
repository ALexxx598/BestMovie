<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $role
 */
class Role extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role',
    ];
}

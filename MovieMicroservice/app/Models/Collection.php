<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string name
 * @property string $type
 */
class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];
}

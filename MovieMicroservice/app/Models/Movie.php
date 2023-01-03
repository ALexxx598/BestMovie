<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $name
 * @property string $description
 * @property string storage_image_link
 * @property string storage_movie_link
 */
class Movie extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'movies';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'role',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'description' => 'array',
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $movie_id
 * @property int $collection_id
 */
class MovieCollection extends Model
{
    use HasFactory;

    protected $table = 'movie_collection';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
        'collection_id',
    ];
}

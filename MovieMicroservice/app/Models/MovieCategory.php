<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $movie_id
 * @property int $category_id
 */
class MovieCategory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'movie_category';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
        'category_id'
    ];
}

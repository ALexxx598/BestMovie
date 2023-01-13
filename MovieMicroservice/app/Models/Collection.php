<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string name
 * @property string $type
 *
 * @property-read \Illuminate\Support\Collection<Movie> $movies
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

    /**
     * @return BelongsToMany
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, MovieCollection::class);
    }
}

<?php

namespace App\Models;

use App\Models\Collection as CollectionModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $name
 * @property string $description
 * @property string storage_image_link
 * @property string storage_movie_link
 *
 * @property-read Collection<Category> $categories
 * @property-read Collection<CollectionModel> $collections
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
        'name',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'description' => 'array',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, MovieCategory::class);
    }

    /**
     * @return BelongsToMany
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(CollectionModel::class, MovieCollection::class);
    }
}

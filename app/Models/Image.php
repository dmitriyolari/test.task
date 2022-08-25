<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property string $filename
 * @property string $path
 * @property int|null $from_url
 * @property string $disk
 * @property string|null $alt
 * @property string|null $title
 * @property string|null $scope
 * @property string|null $url
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image personalScope()
 * @method static Builder|Image publicScope()
 * @method static Builder|Image query()
 * @method static Builder|Image whereAlt($value)
 * @method static Builder|Image whereDisk($value)
 * @method static Builder|Image whereFilename($value)
 * @method static Builder|Image whereFromUrl($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereImageableId($value)
 * @method static Builder|Image whereImageableType($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereScope($value)
 * @method static Builder|Image whereTitle($value)
 * @method static Builder|Image whereUrl($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'filename',
        'path',
        'from_url',
        'disk',
        'alt',
        'title',
        'scope'
    ];

    public function getUrlAttribute(): ?string
    {
        return Storage::disk($this->disk)->get("$this->path/$this->filename");
    }

    /**
     * Scope a query to group personal images.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePersonalScope(Builder $query): Builder
    {
        return $query->where('scope', '=', 'personal');
    }

    /**
     * Scope a query to group personal images.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublicScope(Builder $query): Builder
    {
        return $query->where('scope', '=', 'public');
    }
}

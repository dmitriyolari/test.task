<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

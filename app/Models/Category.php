<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'brands_has_categories', 'brand_id', 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'code',
        'display_on_home',
        'banner_title',
        'banner_description'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'brands_has_categories', 'category_id', 'brand_id');
    }
}

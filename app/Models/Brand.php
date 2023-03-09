<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property int $display_on_home
 * @property string|null $banner_title
 * @property string|null $banner_description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereBannerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereBannerTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereDisplayOnHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereTitle($value)
 * @mixin \Eloquent
 */
class Brand extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public static $snakeAttributes = false;

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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('logo')
            ->singleFile();
    }

}

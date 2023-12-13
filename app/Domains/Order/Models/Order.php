<?php

namespace App\Domains\Order\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class Order extends Model
{
    use HasFactory,
        HasSlug;

    protected $table = "orders";

    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}

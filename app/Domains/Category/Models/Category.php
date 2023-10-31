<?php

namespace App\Domains\Category\Models;

use App\Domains\Category\Models\Traits\Attribute\CategoryAttribute;
use App\Domains\Category\Models\Traits\Relationship\CategoryRelationship;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domains\Category\Models\Traits\Scope\CategoryScope;

/**
 * Class Announcement.
 */
class Category extends Model
{
    use HasFactory, 
    HasSlug,
    SoftDeletes,
    CategoryScope,
    CategoryAttribute,
    CategoryRelationship;

    protected $table = "categories";
    protected $fillable = [
        'name',
        'slug',
        'creator_id',
    ];

    protected $dates = ['deleted_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}

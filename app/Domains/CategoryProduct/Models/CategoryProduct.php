<?php

namespace App\Domains\CategoryProduct\Models;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';
    
    protected $fillable = [
        'category_id',
        'product_id',
    ];
}

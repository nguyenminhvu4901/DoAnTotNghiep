<?php

namespace App\Domains\Favourite\Models;

use App\Domains\Favourite\Models\Traits\Relationship\FavouriteRelationship;
use App\Domains\Favourite\Models\Traits\Scope\FavouriteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class Favourite extends Model
{
    use HasFactory,
        FavouriteRelationship,
        FavouriteScope;

    protected $table = "favourites";

    protected $fillable = [
        'user_id',
        'product_id'
    ];
}

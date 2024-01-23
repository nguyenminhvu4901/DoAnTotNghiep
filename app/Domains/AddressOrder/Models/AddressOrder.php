<?php

namespace App\Domains\AddressOrder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Announcement.
 */
class AddressOrder extends Model
{
    use HasFactory;

    protected $table = "address_order";
    protected $fillable = [
        'province',
        'district',
        'ward',
        'address'
    ];
}

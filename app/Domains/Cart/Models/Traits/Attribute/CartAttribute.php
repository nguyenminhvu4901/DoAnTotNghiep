<?php

namespace App\Domains\Cart\Models\Traits\Attribute;

use Illuminate\Support\Facades\Storage;

trait CartAttribute
{
    public function getDefaultImageCart()
    {
        return asset('storage/images/carts/default/default.jpg');
    }
}

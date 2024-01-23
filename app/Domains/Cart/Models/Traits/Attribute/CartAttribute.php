<?php

namespace App\Domains\Cart\Models\Traits\Attribute;

use Illuminate\Support\Facades\Storage;

trait CartAttribute
{
    public function getDefaultImageCartAttribute()
    {
        return asset('storage/images/carts/default/default.jpg');
    }

    public function getImageProductInCartAttribute()
    {
        if (!$this->product->first()->productImages->pluck('image_path')->isEmpty()) {
            return asset('storage/images/products/' .
                $this->product->first()->productImages->pluck('image_path')->first());
        }

        return asset('storage/images/products/default/ProductImageDefault.jpg');
    }
}

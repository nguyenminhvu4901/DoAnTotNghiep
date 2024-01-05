<?php

namespace App\Domains\ProductImage\Models\Traits\Attribute;

use Illuminate\Support\Facades\Storage;

trait ProductImageAttribute
{
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/images/products/' . $this->image_path);
        }

        return asset('storage/images/products/default/ProductImageDefault.jpg');
    }
}

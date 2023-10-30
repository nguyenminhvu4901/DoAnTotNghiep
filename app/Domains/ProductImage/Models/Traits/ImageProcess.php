<?php

namespace App\Domains\ProductImage\Models\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait ImageProcess
{
    public function checkImage(Request $request, String $key) :Bool
    {
        return $request->hasFile($key);
    }

    public function storeImageProduct(Request $request, String $key): String
    {
        if ($this->checkImage($request, $key)) {
            $image = Image::make($request->file('image_path'));
            $imageName = time() . '-' . $request->file('image_path')->getClientOriginalName();
            $destinationPath = storage_path('app/public/images/products/');
            $image->save($destinationPath . $imageName);

            return $imageName;
        }
        return config('constants.');
    }
}

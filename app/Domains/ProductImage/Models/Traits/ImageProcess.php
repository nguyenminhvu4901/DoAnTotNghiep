<?php

namespace App\Domains\ProductImage\Models\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait ImageProcess
{
    public function verify(Request $request, String $key): Bool
    {
        return $request->hasFile($key);
    }

    public function saveImage(Request $request, String $key): String
    {
        if ($this->verify($request, $key)) {
            $image = Image::make($request->file('image_path'))->encode();
            $imageName = time() . '-' . $request->file('image_path')->getClientOriginalName();
            $pathImage = $this->getPathSave($imageName);
            Storage::disk('image')->put($pathImage, $image);
            return $imageName;
        }
        return config('constants.image_product_default');
    }

    public function updateImage(Request $request, String $currentImage): String
    {
        if ($this->verify($request, $currentImage)) {
            $this->deleteImage($request->get('old_image'));
            return $this->saveImage($request, $currentImage);
        }
        return $request->get('old_image');
    }

    public function deleteImage($name): void
    {
        $oldImage = basename($name);
        Storage::disk('image')->delete($this->getPathSave($oldImage));
    }

    public function exitsImage($name): bool
    {
        return Storage::disk('image')->exists($this->getPathSave($name));
    }

    public function getPathSave($name): string
    {
        return '/products' . '/' . $name;
    }
}

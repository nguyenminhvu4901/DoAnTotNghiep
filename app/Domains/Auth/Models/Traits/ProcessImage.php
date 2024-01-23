<?php

namespace App\Domains\Auth\Models\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class UserScope.
 */
trait ProcessImage
{
    public function verify(Request $request, string $key): bool
    {
        return $request->hasFile($key);
    }

    public function saveImage(Request $request, string $key): string
    {
        if ($this->verify($request, $key)) {
            $originalName = $request->file('avatar')->getClientOriginalName();
            $extension = $request->file('avatar')->getClientOriginalExtension();

            // Remove spaces and dots from the original name without affecting the extension
            $imageName = time() . '-' . str_replace([' ', '.'], '', pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            $image = Image::make($request->file('avatar'))->encode();
            $pathImage = $this->getPathSave($imageName);

            Storage::disk('image')->put($pathImage, $image);
            return $imageName;
        }

        return 'https://gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=' . config('boilerplate.avatar.size', null) . '&d=mp';
    }

    public function updateImage(Request $request, string $currentImage): string
    {
        if ($this->verify($request, $currentImage)) {
            $this->deleteImage($request);
            return $this->saveImage($request, $currentImage);
        }
        return $request->get('old-image');
    }

    public function deleteImage(Request $request): void
    {
        $oldImage = basename($request->get('old-image'));

        Storage::disk('image')->delete($this->getPathSave($oldImage));
    }

    public function exitsImage($name): bool
    {
        return Storage::disk('image')->exists($this->getPathSave($name));
    }

    public function getPathSave($name): string
    {
        return '/avatars' . '/' . $name;
    }
}

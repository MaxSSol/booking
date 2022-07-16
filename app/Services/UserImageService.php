<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UserImageService
{
    public function uploadImage($user, $image)
    {
        if (isset($user->image) && $image) {
            Storage::delete('/public/users/' . $user->image);
            $imageName = time() . '.' . $image->extension();
            Storage::putFileAs('/public/users/', $image, $imageName);
            return $imageName;
        }

        if ($image) {
            $imageName = time() . '.' . $image->extension();
            Storage::putFileAs('/public/users/', $image, $imageName);
            return $imageName;
        }
    }

    public function deleteImage($user)
    {
        if (Storage::exists('/public/users/' . $user->image)) {
            Storage::delete('/public/users/' . $user->image);
            return null;
        }
        return null;
    }
}

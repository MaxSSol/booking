<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UserService
{
    public function updateImage($user, $request)
    {
        if (isset($user->image) && $request->image) {
            Storage::delete('/users/' . $user->image);
            $imageName = time() . '.' . $request->image->extension();
            Storage::putFileAs('/users/', $request->image, $imageName);
            return $imageName;
        }

        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            Storage::putFileAs('/users/', $request->image, $imageName);
            return $imageName;
        }

        if (isset($user->image) && $request->deleteImage) {
            Storage::delete('/users/' . $user->image);
            return null;
        }
    }
}

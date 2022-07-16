<?php

namespace App\Services;

use App\Exceptions\AccommodationImageException;
use App\Models\AccommodationImage;
use Illuminate\Support\Facades\Storage;

class AccommodationImageService
{
    /**
     * @throws AccommodationImageException
     */
    public function upload($images, $id)
    {
        $uploaded = '';
        foreach ($images as $key => $image) {
            $imageName = time() . $key . '.' . $image->extension();
            Storage::putFileAs('/public/accommodation/', $image, $imageName);
            $uploaded = AccommodationImage::create(['accommodation_id' => $id, 'image' => $imageName, 'order' => 1]);
        }

        if ($uploaded) {
            return true;
        }

        throw new AccommodationImageException('Accommodation image upload problem');
    }

    /**
     * @throws AccommodationImageException
     */
    public function deleteImage($images)
    {
        $deleted = '';
        foreach ($images as $image) {
            if (Storage::exists('/public/accommodation/' . $image)) {
                Storage::delete('/public/accommodation/' . $image);
                $deleted = AccommodationImage::where('image', $image)->delete();
            }
        }
        if ($deleted) {
            return true;
        }

        throw new AccommodationImageException('Accommodation image delete problem');
    }
}

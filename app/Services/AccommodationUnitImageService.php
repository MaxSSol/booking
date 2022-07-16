<?php

namespace App\Services;

use App\Exceptions\AccommodationImageException;
use App\Models\AccommodationUnit;
use App\Models\AccommodationUnitImage;
use Illuminate\Support\Facades\Storage;

class AccommodationUnitImageService
{
    /**
     * @throws AccommodationImageException
     */
    public function upload($images, $id)
    {
        $uploaded = '';
        foreach ($images as $key => $image) {
            $imageName = time() . $key . '.' . $image->extension();
            Storage::putFileAs('/public/accommodation/units/', $image, $imageName);
            $uploaded = AccommodationUnitImage::create(
                [
                    'accommodation_unit_id' => $id,
                    'image' => $imageName,
                    'order' => 1
                ]
            );
        }

        if ($uploaded) {
            return true;
        }

        throw new AccommodationImageException('Accommodation unit image upload problem');
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
                $deleted = AccommodationUnitImage::where('image', $image)->delete();
            }
        }
        if ($deleted) {
            return true;
        }

        throw new AccommodationImageException('Accommodation image delete problem');
    }
}

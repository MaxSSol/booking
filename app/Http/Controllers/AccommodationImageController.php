<?php

namespace App\Http\Controllers;

use App\Exceptions\AccommodationImageException;
use App\Services\AccommodationImageService;
use Illuminate\Http\Request;

class AccommodationImageController extends Controller
{
    protected AccommodationImageService $accommodationImageService;

    public function __construct(AccommodationImageService $accommodationImageService)
    {
        $this->accommodationImageService = $accommodationImageService;
    }

    public function upload(Request $request, $id)
    {
        try {
            $uploaded = $this->accommodationImageService->upload($request->image, $id);

            if ($uploaded) {
                return response()->json(['status' => 'true']);
            }

        } catch (AccommodationImageException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $deleted = $this->accommodationImageService->deleteImage($request->image);

            if ($deleted) {
                return response()->json(['status' => 'true']);
            }

        } catch (AccommodationImageException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}

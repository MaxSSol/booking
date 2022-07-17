<?php

namespace App\Http\Controllers;

use App\Exceptions\AccommodationImageException;
use App\Services\AccommodationUnitImageService;
use Illuminate\Http\Request;

class AccommodationUnitImageController extends Controller
{
    protected AccommodationUnitImageService $accommodationUnitImageService;

    public function __construct(AccommodationUnitImageService $accommodationUnitImageService)
    {
        $this->accommodationUnitImageService = $accommodationUnitImageService;
    }

    public function upload(Request $request, $id)
    {
        try {
            $uploaded = $this->accommodationUnitImageService->upload($request->image, $id);
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
            $deleted = $this->accommodationUnitImageService->deleteImage($request->image);

            if ($deleted) {
                return response()->json(['status' => 'true']);
            }

        } catch (AccommodationImageException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserImageRequest;
use App\Models\User;
use App\Services\UserImageService;
use Illuminate\Support\Facades\Auth;

class UserImageController extends Controller
{
    public UserImageService $userImageService;

    public function __construct(UserImageService $userImageService)
    {
        $this->userImageService = $userImageService;
        $this->middleware('auth:sanctum');
    }

    public function upload(UpdateUserImageRequest $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($request->hasFile('image')) {
            $image = $this->userImageService->uploadImage($user, $request->image);
            $user->update(['image' => $image]);
            return response()->json(['user' => $user]);
        }

        return response()->json(['error' => 'true', 'user' => Auth::user()], 404);
    }

    public function delete()
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->image) {
            $image = $this->userImageService->deleteImage($user);
            $user->update(['image' => $image]);
            return response()->json(['user' => $user]);
        }

        return response()->json(['user' => $user]);
    }
}

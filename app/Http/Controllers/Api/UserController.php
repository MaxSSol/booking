<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        return $request->user();
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = Auth::user();
        $validated = collect($request->validated());
        
        if ($request->hasFile('image')) {
            $image = $this->userService->updateImage($user, $request);
            $validated['image'] = $image;
        }
        $validated->forget('deleteImage');

        $user = User::findOrFail(Auth::user()->id);
        $user->update($validated->all());

        return response()->json(Auth::user());
    }
}

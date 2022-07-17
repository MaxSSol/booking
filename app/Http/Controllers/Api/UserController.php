<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json(['user' => Auth::user()]);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $validated = collect($request->validated());

        $user = User::findOrFail(Auth::user()->id);
        $user->update($validated->all());

        return response()->json(['user' => $user]);
    }
}

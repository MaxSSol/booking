<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authentication(AuthenticateLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            return response()->json(['user' => Auth::user()]);
        }

        return response()->json(['error' => 'Перевірте правельність даних.'], 400);
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(null, 200);
    }
}

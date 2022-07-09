<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(StoreRegistrationRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        Auth::login($user);

        return response()->json(['user' => Auth::user()]);

    }
}

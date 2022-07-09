<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['status' => 'Повідомлення відправлено']);
    }

    public function verifyEmail(Request $request)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->to('/profile/verify')->withCookies(['failed' => 'Посилання не дійсне']);
        }

        $user = User::findOrFail($request->id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/');
    }
}

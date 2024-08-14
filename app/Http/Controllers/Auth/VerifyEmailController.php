<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\CustomEmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    public function __invoke(CustomEmailVerificationRequest  $request)
    {
        $user = \App\Models\User::findOrFail($request->route('id'));

        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            return redirect('/')->withErrors(['email' => 'Invalid verification link']);
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('/')->withErrors(['email' => 'Invalid verification link']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('status', 'Email already verified');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/')->with('status', 'Email verified');
    }
}

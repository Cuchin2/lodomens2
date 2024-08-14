<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class CustomEmailVerificationRequest extends FormRequest
{
    public function authorize()
    {
        $user = User::find($this->route('id'));

        if (!$user) {
            return false;
        }

        if (!hash_equals((string) $this->route('id'), (string) $user->getKey())) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function fulfill()
    {
        $user = User::find($this->route('id'));

        if ($user && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }
    }
}

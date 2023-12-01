<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'subscription_email'=>'email:rfc,dns|unique:App\Models\Subscription,email',
        ];
    }
    public function messages()
    {
    return [
        'subscription_email.unique'=>'Ya hay una subscrición con este correo electrónico',
    ];
    }
}

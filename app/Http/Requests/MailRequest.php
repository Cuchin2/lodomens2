<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'subject' => 'required'
        ];
    }
    public function messages()
    {
    return [
        'name.required' => 'El campo nombre es requerido',
        'email.required' => 'El campo correo es requerido',
        'email.email' => 'El campo correo debe ser una dirección de correo electrónico válida,',
        'body.required' => 'El campo mensaje es requerido',
        'subject.required' => 'El campo asunto es requerido',
    ];
    }
}

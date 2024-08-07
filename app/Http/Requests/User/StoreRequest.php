<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'profile_photo_url'=>'required',
        ];
    }
    public function messages()
    {
        return [
        'name.required'=>'El nombre es requerido.',
        'name.string'=>'El nombre no es correcto.',
        'name.max'=>'Solo se permite 255 caracteres.',

        'last_name.required'=>'Apellido es requerido.',
        'last_name.string'=>'Apellido no es correcto.',
        'last_name.max'=>'Solo se permite 255 caracteres.',

        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe ser mínimo 6 carácteres.',
        'dni.string'=>'El valor no es correcto.',
        'dni.required'=>'Este campo es requerido.',
        'dni.unique'=>'Este DNI ya se encuentra registrado.',
        'dni.min'=>'Se requiere de 8 caracteres.',
        'dni.max'=>'Solo se permite 8 caracteres.',

        'ruc.string'=>'El valor no es correcto.',
        'ruc.unique'=>'Este RUC ya se encuentra registrado.',
        'ruc.min'=>'Se requiere de 11  caracteres.',
        'ruc.max'=>'Solo se permite 11 caracteres.',

        'address.string'=>'El valor no es correcto.',
        'address.max'=>'Solo se permite 255 caracteres.',

        'phone.string'=>'El valor no es correcto.',
        'phone.unique'=>'Este número de celular ya se encuentra registrado.',
        'phone.min'=>'Se requiere de 9 caracteres.',
        'phone.max'=>'Solo se permite 9 caracteres.',

        'email.string'=>'El valor no es correcto.',
        'email.unique'=>'La dirreción de correo electrónico ya se encuentra registrada.',
        'email.email'=>'No es un correo elecrónico.',

        'profile_photo_url.required'=>'La foto es obligatoria'
    ];
    }
}

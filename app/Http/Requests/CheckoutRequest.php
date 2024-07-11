<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'=> 'required',
            'last_name' => 'required',
            'document_type' => 'required',
            'dni' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'district' => 'required',
        ];

        if ($this->input('otra') == 'true') {
            $rules['name2'] = 'required';
            $rules['last_name2'] = 'required';
            $rules['country2'] = 'required';
            $rules['address2'] = 'required';
            $rules['city2'] = 'required';
            $rules['state2'] = 'required';
            $rules['district2'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'document_type.required' => 'El Tipo de documento es obligatorio.',
            'dni.required' => 'El número de documento es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'country.required' => 'Elija un país.',
            'address.required' => 'La dirección es obligatoria',
            'city.required' => 'Elija una ciudad',
            'state.required' => 'Elija un estado/provincia',
            'district.required' => 'Elija un distrito/localidad',

            'name2.required'=>'El nombre es obligatorio.',
            'last_name2.required'=> 'El Apellido es obligatorio.',
            'country2.required'=> 'Elija un país.',
            'address2.required' => 'La dirección es obligatoria',
            'city2.required' => 'Elija una ciudad',
            'state2.required'=> 'Elija un estado/provincia',
            'district2.required'=> 'Elija un distrito/localidad',
        ];
    }
}

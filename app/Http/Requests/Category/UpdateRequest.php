<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'unique:categories|required|string|max:50' ,
            'description' => 'nullable|string|max:255' ,
           ];
       }
       public function messages()
       {
           return [
            'name.unique'=>'Ya existe una categoría con ese nombre',
           'name.required'=>'Este campo es requerido',
           'name.string'=>'El valor no es correcto',
           'name.max'=>'Solo se permite 50 caracteres',
           'description.string'=>'El valor no es correcto',
           'description.max'=>'Solo se permite 255 caracteres',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombres'=>'required|max:100',
            'apellidos'=>'requireed|max:100',
            'fecha_nacimiento'=>'required|max:100',
            'dui'=>'required|max:10',
            'telefono'=>'max:8',
        ];
    }
}

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
            'nombres'=>'required|string|max:75',
            'apellidos'=>'required|string|max:75',
            'nacimiento'=>'required|date',
            'dui'=>'required|string|max:10',
            'telefono'=>'required|string|max:9',
        ];
    }
}

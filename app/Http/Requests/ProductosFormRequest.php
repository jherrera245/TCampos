<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosFormRequest extends FormRequest
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
            'nombre' =>'required|string|max:75',
            'codigo' =>'required|string|max:75',
            'stock' =>'required|integer',
            'descripcion' => 'required|string|max:200',
            'imagen' => 'max:200',
            'categoria' => 'required|integer',
            'marca'=>'required|integer',
        ];
    }
}

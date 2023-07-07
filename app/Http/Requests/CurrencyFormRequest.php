<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurrencyFormRequest extends FormRequest
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

        switch ($this->method()) {
            case "POST": {
                return [
                    'name' => 'required|string|min:3|max:8|unique:currencies',
                ];
            }
            case "PUT": {
                return [
                    'name' => 'required|string|min:3|max:8|unique:currencies',
                ];
            }
            default: {
                return [];
            }
        }  
        
    }

    public function failedValidation(Validator $validator)
    {   
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ],  422));
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre es requerido',
        ];
    }
}

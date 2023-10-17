<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DirectoryStoreRequest extends FormRequest
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
            'nombre' => 'required|string|min:3|max:300',
            'especialidad' => 'required|string|min:3|max:300',
            'universidad' => 'required|string|min:3|max:300',
            'email' => 'required|string|min:3|max:300',
            'direccion' => 'required|string|min:3|max:300',
            'telprincipal' => 'required|string|min:3|max:301',
            'status' => 'required',
            'image' => 'sometimes',
        ];
    }

    public function failedValidation(Validator $validator)
    {   
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ],  422));
    }
}

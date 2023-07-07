<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PlanStoreRequest extends FormRequest
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
            'name' => ['required', Rule::unique('plans')->whereNull('deleted_at')],
            'price'  => 'required|numeric',
            'description'  => 'required',
            'color'  => 'required',
            'tiempo'  => 'required',
            'currency_id' => [
                'required',
                Rule::exists('currencies', 'id')
            ],
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

    public function messages()
    {
        return [
            'name.required' => 'Nombre es requerido',
            'name.unique' => 'El nombre del plan ya es utilizando',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe de ser númerido',
            'description.required' => 'Descripcion es requerido',
            'color.required' => 'Color es requerido',
            'tiempo.required' => 'tiempo es requerido',
            'currency_id.required' => 'La moneda o divisa es requerido',
            'currency_id.exists' => 'La divisa o moneda no existe',
        ];
    }
}

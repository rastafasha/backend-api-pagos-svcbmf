<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentFormRequest extends FormRequest
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
        // return [
        //     'referencia' => 'required|string|min:3|max:150',
        //     'metodo' => 'required|string|min:3|max:150',
        //     'bank_name' => 'required|string|min:3|max:150',
        //     'monto' => 'required|string|min:3|max:150',
        //     'validacion' => 'required|string|min:3|max:150',
        //     'currency_id' => [
        //         'required',
        //         Rule::exists('currencies', 'id')
        //     ],
        //     'moneda_codigo' => 'required|string|min:3|max:150',
        //     'nombre' => 'required|string|min:3|max:150',
        //     'email' => 'required|string|min:3|max:150',
        //     'txn_id' => 'required',
        //     'user_id' => [
        //         'required',
        //         Rule::exists('users', 'id')
        //     ],
        //     'plan_id' => [
        //         'required',
        //         Rule::exists('plans', 'id')
        //     ],
        //     'image' => 'sometimes',
        // ];

        switch ($this->method()) {
            case "POST": {
                    return [
                        'referencia' => 'required|string|min:3|max:150',
                        'metodo' => 'required|string|min:3|max:150',
                        'bank_name' => 'required|string|min:3|max:150',
                        'monto' => 'required|string|min:3|max:150',
                        'validacion' => 'required|string|min:3|max:150',
                        'currency_id' => [
                            'required',
                            Rule::exists('currencies', 'id')
                        ],
                        'nombre' => 'required|string|min:3|max:150',
                        'email' => 'required|string|min:3|max:150',
                        'user_id' => [
                            'required',
                            Rule::exists('users', 'id')
                        ],
                        'plan_id' => [
                            'required',
                            Rule::exists('plans', 'id')
                        ],
                        'image' => 'sometimes',
                    ];
                }
            case "PUT": {
                    return [
                        'validacion' => 'required|string|min:3|max:150',
                        'status' => ['required',
                            Rule::in(Payment::statusTypes())
                    ],
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

    // public function messages()
    // {
    //     return [
    //         'name.required' => 'Nombre es requerido',
    //     ];
    // }
}

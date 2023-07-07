<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactFormRequest extends FormRequest
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
                'phone' => 'required|min:8|max:14',
                'email' => 'required|email',
                'subject' => 'required|min:5|max:25',
                'comment' => 'required|min:10|max:500',
                'status' => ['required',
                Rule::in(Contact::statusTypes())
        ],
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

<?php

namespace Modules\Basics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestClient extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($client = null)
    {
        return [
            'identification' => ['required', 'numeric', Rule::unique('basic_clients')->ignore($client)],
            'first_name' => 'nullable|string|max:100|min:4',
            'last_name' => 'nullable|string|max:100|min:4',
            'client_name' => 'nullable|string|max:100|min:4',
            'type_document' => 'nullable|max:3',
            'address' => 'nullable|max:192',
            'phone' => 'nullable',
            'cel_phone' => 'nullable',
            'entry_date' => 'nullable|date',
            'email' => ['nullable', 'email', 'max:100', Rule::unique('basic_clients')->ignore($client)],
            'gender' => ['nullable', 'max:1', Rule::in(['M', 'F', 'O'])],
            'type' => ['nullable', 'max:10', Rule::in(['Proveedor', 'Cliente', 'Otro'])],
            'birth_date' => 'nullable|date',
            'limit' => 'nullable',
            'vendedor_id' => 'nullable',
            'typeprice_id' => 'nullable',
            'shoppingcontact' => 'nullable|max:100',
            'conditionpayment_id' => 'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

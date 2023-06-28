<?php

namespace Modules\Basics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestEmployee extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($employee = null)
    {
        return [
            'identification' => ['required', 'numeric', Rule::unique('basic_employees')->ignore($employee)],
            'first_name' => 'required|string|max:100|min:4',
            'last_name' => 'required|string|max:100|min:4',
            'type_document' => 'required|max:2',
            'address' => 'nullable|max:192',
            'phone' => 'nullable',
            'cel_phone' => 'nullable',
            'entry_date' => 'nullable|date',
            'email' => ['nullable', 'email', 'max:100', Rule::unique('basic_employees')->ignore($employee)],
            'vendedor' => 'nullable',
            'gender' => ['nullable', 'max:1', Rule::in(['M', 'F', 'O'])],
            'birth_date' => 'nullable|date',
            'location_id' => 'nullable',
            'approve' => 'nullable',
            'photo_path' => 'nullable'
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

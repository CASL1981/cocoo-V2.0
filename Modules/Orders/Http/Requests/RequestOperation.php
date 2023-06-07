<?php

namespace Modules\Orders\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestOperation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'document' => 'required',
            'date' => 'required|date',
            'basic_client_id' => 'required',
            'basic_payment_id' => 'required',
            'basic_payment_interval' => 'nullable',
            'observation' => 'nullable|max:255',
            'delivery_time' => 'nullable|max:50',
            'basic_type_price_id' => 'required',
            'biller' => 'required|numeric',
            'responsible' => 'required|numeric',
            'basic_classification_id' => 'required',
            'brute' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'subtotal' => 'nullable|numeric',
            'tax_sale' => 'nullable|numeric',
            'total' => 'nullable|numeric',
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

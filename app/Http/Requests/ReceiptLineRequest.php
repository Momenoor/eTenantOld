<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptLineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reciept' => 'required|integer|exists:reciepts,id',
            'installment' => 'required|integer|exists:installments,id',
            'amount' => 'required|numeric|between:-999999.99,999999.99',
            'narration' => 'nullable|nullable|string',
            'received_at' => 'required|date',
            'type' => 'required|integer|exists:types,id',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}

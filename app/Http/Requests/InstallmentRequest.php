<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentRequest extends FormRequest
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
            'amount' => 'required|numeric|between:-999999.99,999999.99',
            'number' => 'nullable|nullable|string',
            'date' => 'required|date',
            'bank_name' => 'required|string',
            'narration' => 'nullable|nullable|string',
            'contract' => 'required|integer|exists:contracts,id',
            'status' => 'required|integer|exists:types,id',
            'type' => 'required|integer|exists:types,id',
            'category' => 'required|integer|exists:types,id',
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

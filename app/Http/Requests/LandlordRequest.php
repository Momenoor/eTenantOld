<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandlordRequest extends FormRequest
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
            'name' => 'required|string',
            'display_name' => 'nullable|nullable|string',
            'phone' => 'nullable|nullable|string',
            'email' => 'nullable|nullable|email',
            'bank_name' => 'nullable|nullable|string',
            'bank_account_name' => 'nullable|nullable|string',
            'bank_account_number' => 'nullable|nullable|string',
            'user' => 'required|integer|exists:users,id',
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

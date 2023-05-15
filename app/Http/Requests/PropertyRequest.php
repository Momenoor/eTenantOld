<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'code' => 'required|string',
            'floor_count' => 'nullable|nullable|integer',
            'makani' => 'nullable|nullable|string',
            'premises' => 'nullable|nullable|string',
            'condition' => 'nullable|nullable|string',
            'address' => 'nullable|nullable|string',
            'emirate' => 'required|in:Abu Dhabi,Dubai,Sharjah,Ajman,Ras Al Khaimah,Umm Al Quwain,Fujairah',
            'description' => 'nullable|nullable|string',
            'type' => 'required|integer|exists:types,id',
            'landlord' => 'required|integer|exists:landlords,id',
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

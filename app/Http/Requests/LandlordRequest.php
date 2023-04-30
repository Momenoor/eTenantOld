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
        $rules =  [
            'name' => 'required|string',
            'display_name' => 'nullable|nullable|string',
            'phone' => 'required|nullable|nullable|string',
            'email' => 'required|nullable|nullable|email',
            'bank_name' => 'required|nullable|nullable|string',
            'bank_account_name' => 'required|nullable|nullable|string',
            'bank_account_number' => 'required|nullable|nullable|string',
            'user.name' => 'required_if:create_user_switch,true|string',
            'user.email' => 'required_if:create_user_switch,true|email|unique:users,email',
        ];

        if ($this->isMethod('put')) {
            $rules['user.email'] = 'required_if:create_user_switch,true|email|unique:users,email,' . $this->user->id . ',id';
        }

        return $rules;
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

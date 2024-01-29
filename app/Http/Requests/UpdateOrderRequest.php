<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|integer|exists:users,id',
            'restaurant_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Client Id is required',
            'client_id.exists' => 'Client Id does not exist',
            'restaurant_id.required' => 'Restaurant Id is required',
            'restaurant_id.exists' => 'Restaurant Id does not exist',
        ];
    }
}

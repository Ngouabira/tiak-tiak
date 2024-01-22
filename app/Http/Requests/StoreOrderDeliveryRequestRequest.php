<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDeliveryRequestRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id',
            'deliver_id' => 'nullable|exists:users,id',
            'status' => 'in:pending,accepted,completed,canceled',
        ];
    }
    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required',
            'order_id.exists' => 'Order ID does not exist',
            'deliver_id.exists' => 'Deliver ID does not exist',
            'status.in' => 'Status must be one of the following: pending, accepted, completed',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderDeliveryRequest extends FormRequest
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
            'startposition' => 'required|string|max:255',
            'endposition' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'status' => 'in:pending,accepted,completed,canceled', // Adjust status values based on your requirements
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required',
            'order_id.exists' => 'Order ID does not exist',
            'deliver_id.exists' => 'Deliver ID does not exist',
            'startposition.required' => 'Start position is required',
            'startposition.string' => 'Start position must be a string',
            'startposition.max' => 'Start position must not exceed 255 characters',
            'endposition.required' => 'End position is required',
            'endposition.string' => 'End position must be a string',
            'endposition.max' => 'End position must not exceed 255 characters',
            'distance.required' => 'Distance is required',
            'distance.numeric' => 'Distance must be a number',
            'distance.min' => 'Distance must be greater than or equal to 0',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be a number',
            'amount.min' => 'Amount must be greater than or equal to 0',
            'status.in' => 'Status must be one of the following: pending, accepted, completed, canceled',
        ];
    }
}

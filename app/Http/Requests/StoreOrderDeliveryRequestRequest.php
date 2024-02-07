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
            'order_id' => 'required|integer|exists:orders,id',
            'deliver_id' => 'required|integer|exists:users,id',
            'status' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'order_id.required' => 'Commande est obligatoire',
            'order_id.integer' => 'Commande doit être un entier',
            'order_id.exists' => 'Commande doit exister',
            'deliver_id.required' => 'Livraison est obligatoire',
            'deliver_id.integer' => 'Livraison doit être un entier',
            'deliver_id.exists' => 'Livraison doit exister',
            'status.required' => 'status est obligatoire',
            
            
        ];
    }
}

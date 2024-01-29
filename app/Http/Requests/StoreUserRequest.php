<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|max:255',
            'profile_id' => 'required|integer|exists:profiles,id',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'status' => '',
            'points' => '',
            'cni' => '',
            'image' => '',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return  [
            'name.required' => 'Le nom est obligatoire',
            'name.string' => 'Le nom doit être une chaîne de caractères',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'L\'email doit être unique',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères',
            'password.max' => 'Le mot de passe ne doit pas dépasser 255 caractères',
            'profile_id.required' => 'Le profile est obligatoire',
            'profile_id.integer' => 'Le profile doit être un entier',
            'profile_id.exists' => 'Le profile doit exister',
            'phone.required' => 'Le phone est obligatoire',
            'phone.string' => 'Le phone doit être une chaîne de caractères',
            'phone.max' => 'Le phone ne doit pas dépasser 255 caractères',
            'address.required' => 'L\'address est obligatoire',
            'address.string' => 'L\'address doit être une chaîne de caractères',
            'gender.required' => 'Le genre est obligatoire',
            'gender.string' => 'Le genre doit être une chaîne de caractères',
            'gender.max' => 'Le genre ne doit pas dépasser 255 caractères',
        ];
    }
}

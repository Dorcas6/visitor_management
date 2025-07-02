<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'apartment' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', Rule::unique('tenants')->ignore($this->tenant)],
            'id_card_number' => ['nullable', 'string', 'max:255', Rule::unique('tenants')->ignore($this->tenant)],
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('tenants')->ignore($this->tenant)],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Le nom du locataire',
            'apartment' => "L'appartement",
            'phone' => 'Le numéro de téléphone',
            'id_card_number' => 'Le numéro de CNI',
            'email' => 'L\'adresse email'   
        ];
    }
}

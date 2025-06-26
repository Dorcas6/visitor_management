<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "max:255", "min:4"],
            "email" => ["required", "email", "max:255", Rule::unique('users')->ignore($this->user)]
        ];
    }

    public function attributes()
    {
        return [
            "name" => "Le nom de l'agent de sécurité",
            "email" => "L'email de l'agent de sécurité"
        ];
    }
}

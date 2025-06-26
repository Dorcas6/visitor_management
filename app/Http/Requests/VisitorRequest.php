<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "last_name" => ["required", "string", "max:255", "min:2"],
            "first_name" => ["required", "string", "max:255", "min:2"],
            "phone_number" => ["required", "string", "max:20"],
            "icn" => ["required", "string", "max:20", Rule::unique('visitors')->ignore($this->visitor)]
        ];
    }

    public function attributes()
    {
        return [
            "last_name" => "Le nom du visiteur",
            "first_name" => "Le prénom du visiteur",
            "phone_number" => "Le numéro de téléphone du visiteur",
            "icn" => "Le numéro de CNI du visiteur"
        ];
    }
}

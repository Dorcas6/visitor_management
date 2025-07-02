<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "visitor_id" => ["required", "exists:visitors,id"],
            "tenant_id" => ["required", "exists:tenants,id"],
            "time_in" => ["required", "date"],
            "time_out" => ["nullable", "date"],
            "purpose" => ["required", "string", "max:255"]
        ];
    }

    public function attributes()
    {
        return [
            "visitor_id" => "Le visiteur",
            "tenant_id" => "Le locataire",
            "user_id" => "L'utilisateur",
            "time_in" => "L'heure d'arrivée",
            "time_out" => "L'heure de départ",
            "purpose" => "Le motif de la visite"
        ];
    }
}

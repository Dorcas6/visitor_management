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
            "time_out" => ["required", "date"],
            "purpose" => ["required", "string", "max:255"]
        ];
    }

    public function attributes()
    {
        return [
            "visitor_id" => "Le visiteur",
            "tenant_id" => "Le locataire",
            "user_id" => "L'utilisateur",
            "arrival_time" => "L'heure d'arrivée",
            "purpose" => "Le motif de la visite"
        ];
    }
}

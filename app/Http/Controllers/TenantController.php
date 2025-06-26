<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TenantController extends Controller
{
    public function index(): View
    {
        return view("tenants.index")
            ->with("tenants", Tenant::query()->withCount("visits")->get());
    }

    public function create(): View
    {
        return view("tenants.create")->with("tenant", new Tenant());
    }

    public function store(TenantRequest $request): RedirectResponse
    {
        // dd($request->validated());
        Tenant::query()->create($request->validated());

        return to_route("tenants.index")->with("success", "Locataire enregistré avec succès.");
    }

    public function show(Tenant $tenant): View
    {
        return view("tenants.show")->with("tenant", $tenant);
    }

    public function edit(Tenant $tenant): View
    {
        return view("tenants.edit")->with("tenant", $tenant);
    }

    public function update(TenantRequest $request, Tenant $tenant): RedirectResponse
    {
        $tenant->update($request->validated());
        return to_route("tenants.index")->with("success", "Données du locataire mises à jour.");
    }

    public function destroy(Tenant $tenant): RedirectResponse
    {
        if ($tenant->visits()->exists()) {
            return back()->with("warning", "Impossible de supprimer le locataire car il a des visites associées.");
        }

        $tenant->delete();
        return to_route("tenants.index")->with("success", "Locataire supprimé avec succès.");
    }
}

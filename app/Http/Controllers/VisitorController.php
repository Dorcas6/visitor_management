<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VisitorRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function index(): View
    {
        $query = Visitor::query()->withCount("visits");
        
        // Si l'utilisateur est un locataire, on ne montre que ses visiteurs
        if (auth('tenants')->check()) {
            $tenantId = auth('tenants')->id();
            $query->whereHas('visits', function($q) use ($tenantId) {
                $q->where('tenant_id', $tenantId);
            });
        }
        
        return view("visitors.index")
            ->with("visitors", $query->get());
    }

    public function create(): View
    {
        $this->authorize('create', Visitor::class);
        return view("visitors.create")->with("visitor", new Visitor());
    }

    public function store(VisitorRequest $request): RedirectResponse
    {
        $this->authorize('create', Visitor::class);
        
        $visitor = Visitor::create($request->validated());

        return to_route("visitors.show", $visitor)
            ->with("success", "Visiteur enregistré avec succès.");
    }

    public function show(Visitor $visitor): View
    {
        // Vérifier si l'utilisateur a le droit de voir ce visiteur
        if (auth('tenants')->check()) {
            $tenantId = auth('tenants')->id();
            $hasAccess = $visitor->visits()->where('tenant_id', $tenantId)->exists();
            
            if (!$hasAccess) {
                abort(403, 'Accès non autorisé à ce visiteur.');
            }
        }
        
        return view("visitors.show")->with("visitor", $visitor->load('visits'));
    }

    public function edit(Visitor $visitor): View
    {
        $this->authorize('update', $visitor);
        return view("visitors.edit")->with("visitor", $visitor);
    }

    public function update(VisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $this->authorize('update', $visitor);
        
        $visitor->update($request->validated());
        
        return to_route("visitors.show", $visitor)
            ->with("success", "Données du visiteur mises à jour.");
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        $this->authorize('delete', $visitor);
        
        if ($visitor->visits()->exists()) {
            return back()->with("warning", "Impossible de supprimer le visiteur car il a des visites associées.");
        }

        $visitor->delete();
        
        return to_route("visitors.index")
            ->with("success", "Visiteur supprimé avec succès.");
    }
}

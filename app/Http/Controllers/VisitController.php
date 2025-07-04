<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitRequest;
use App\Models\Tenant;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VisitController extends Controller
{
    public function index(Request $request): View
    {
        $query = Visit::query()
            ->with(['visitor', 'tenant', 'user'])
            ->latest('time_in');

        // Si l'utilisateur est un locataire, on ne montre que ses visites
        if (auth('tenants')->check()) {
            $query->where('tenant_id', auth('tenants')->id());
        }

        // Filtrer par statut si spécifié
        if ($request->has('status')) {
            if ($request->status === 'ongoing') {
                $query->whereNull('time_out');
            } elseif ($request->status === 'completed') {
                $query->whereNotNull('time_out');
            }
        } else {
            // Par défaut, ne montrer que les visites en cours
            $query->whereNull('time_out');
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('visitor', function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%");
                });
                
                // Les locataires ne voient pas les recherches par locataire
                if (auth('web')->check()) {
                    $q->orWhereHas('tenant', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('apartment', 'like', "%{$search}%");
                    });
                }
            });
        }

        $visits = $query->paginate(10);

        return view('visits.index', compact('visits'));
    }

    // public function create()
    // {
    //     // $this->authorize('create', Visit::class);
        
    //     $visitors = Visitor::orderBy('last_name')->get();
    //     $tenants = Tenant::orderBy('name')->get();
        
    //     return view('visits.create', compact('visitors', 'tenants'));
    // }

    public function create()
{
    // $this->authorize('create', Visit::class);
    
    $visitors = Visitor::orderBy('last_name')->get();
    $tenants = Tenant::orderBy('name')->get();
    $visit = new Visit(); // Crée une nouvelle instance de Visit
    
    return view('visits.create', compact('visitors', 'tenants', 'visit')); // Ajoutez $visit à compact
}

    public function store(VisitRequest $request): RedirectResponse
    {
        // $this->authorize('create', Visit::class);
        
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        
        // Si c'est un locataire qui crée la visite, on force son ID
        if (auth('tenants')->check()) {
            $data['tenant_id'] = auth('tenants')->id();
        }
        
        $visit = Visit::create($data);
        
        return redirect()->route('visits.show', $visit)
            ->with('success', 'Visite enregistrée avec succès.');
    }

    public function show(Visit $visit): View
    {
        // Vérifier si l'utilisateur a le droit de voir cette visite
        if (auth('tenants')->check() && $visit->tenant_id !== auth('tenants')->id()) {
            abort(403, 'Accès non autorisé à cette visite.');
        }
        
        $visit->load(['visitor', 'tenant', 'user']);
        return view('visits.show', compact('visit'));
    }

    public function edit(Visit $visit): View
    {
       // $this->authorize('update', $visit);
        
        $visitors = Visitor::orderBy('last_name')->get();
        $tenants = Tenant::orderBy('name')->get();
        
        return view('visits.edit', compact('visit', 'visitors', 'tenants'));
    }

    public function update(VisitRequest $request, Visit $visit): RedirectResponse
    {
       // $this->authorize('update', $visit);
        
        $data = $request->validated();
        
        // Si c'est un locataire, on s'assure qu'il ne modifie pas le locataire
        if (auth('tenants')->check()) {
            unset($data['tenant_id']);
        }
        
        $visit->update($data);
        
        return redirect()->route('visits.show', $visit)
            ->with('success', 'Visite mise à jour avec succès.');
    }

    public function markDeparture(Visit $visit): RedirectResponse
    {
       // $this->authorize('update', $visit);
        
        if ($visit->time_out) {
            return back()->with('warning', 'La visite a déjà été clôturée.');
        }
        
        $visit->update([
            'time_out' => now(),
            'user_id' => Auth::id()
        ]);
        
        return back()->with('success', 'Départ enregistré avec succès.');
    }

    public function destroy(Visit $visit): RedirectResponse
    {
       // $this->authorize('delete', $visit);
        
        $visit->delete();
        
        return redirect()->route('visits.index')
            ->with('success', 'Visite supprimée avec succès.');
    }
}

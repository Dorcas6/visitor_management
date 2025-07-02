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
                })->orWhereHas('tenant', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('apartment', 'like', "%{$search}%");
                });
            });
        }

        $visits = $query->paginate(10);

        return view('visits.index', compact('visits'));
    }

    public function create(): View
    {
        return view('visits.create')
            ->with('visit', new Visit())
            ->with('visitors', Visitor::query()->get())
            ->with('tenants', Tenant::query()->get());
    }

    public function store(VisitRequest $request): RedirectResponse
    {

        Visit::query()->create([
            ...$request->validated(),
            'user_id' => Auth::user()->id,
        ]);

        return to_route('visits.index')->with('success', 'Visite enregistrée avec succès.');
    }

    // public function store(Request $request): RedirectResponse
    // {

    //     // dd($request->all(),Auth::user()->id);

    //     Visit::query()->create([
    //         "visitor_id" =>$request->visitor_id,
    //         "tenant_id" => $request->tenant_id,
    //         "time_in" =>$request->get("arrival_time"),
    //         "purpose" => $request->purpose,
    //         "user_id" => Auth::user()->id,
    //     ]);

    //     return to_route("visits.index")->with("success", "Visite enregistrée avec succès.");
    // }

    public function show(Visit $visit): View
    {
        return view('visits.show')->with('visit', $visit);
    }

    public function edit(Visit $visit): View
    {
        return view('visits.edit')
            ->with('visit', $visit)
            ->with('visitors', Visitor::query()->get())
            ->with('tenants', Tenant::query()->get());
    }

    public function update(VisitRequest $request, Visit $visit): RedirectResponse
    {
        $visit->update($request->validated());
        return to_route('visits.index')->with('success', 'Données de la visite mises à jour.');
    }

    /**
     * Marquer l'heure de départ d'une visite
     */
    public function markDeparture(Visit $visit): RedirectResponse
    {
        if ($visit->time_out) {
            return back()->with('error', 'Le départ a déjà été enregistré pour cette visite.');
        }

        $visit->update([
            'time_out' => now()
        ]);

        return back()->with('success', 'Heure de départ enregistrée avec succès.');
    }

    public function destroy(Visit $visit): RedirectResponse
    {
        $visit->delete();
        return to_route('visits.index')->with('success', 'Visite supprimée avec succès.');
    }
}

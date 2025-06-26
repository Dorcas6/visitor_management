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
    public function index(): View
    {
        return view('visits.index')
            ->with('visits', Visit::query()->with(['visitor', 'tenant', 'user'])->get());
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

    public function destroy(Visit $visit): RedirectResponse
    {
        $visit->delete();
        return to_route('visits.index')->with('success', 'Visite supprimée avec succès.');
    }
}

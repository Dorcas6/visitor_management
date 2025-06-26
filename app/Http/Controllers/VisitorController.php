<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VisitorRequest;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function index(): View
    {
        return view("visitors.index")
            ->with("visitors", Visitor::query()->withCount("visits")->get());
    }

    public function create(): View
    {
        return view("visitors.create")->with("visitor", new Visitor());
    }

    public function store(VisitorRequest $request): RedirectResponse
    {
        Visitor::query()->create($request->validated());

        return to_route("visitors.index")->with("success", "Visiteur enregistré avec succès.");
    }

    public function show(Visitor $visitor): View
    {
        return view("visitors.show")->with("visitor", $visitor);
    }

    public function edit(Visitor $visitor): View
    {
        return view("visitors.edit")->with("visitor", $visitor);
    }

    public function update(VisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $visitor->update($request->validated());
        return to_route("visitors.index")->with("success", "Données du visiteur mises à jour.");
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        if ($visitor->visits()->exists()) {
            return back()->with("warning", "Impossible de supprimer le visiteur car il a des visites associées.");
        }

        $visitor->delete();
        return to_route("visitors.index")->with("success", "Visiteur supprimé avec succès.");
    }
}

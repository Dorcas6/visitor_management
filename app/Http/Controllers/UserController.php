<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;	
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
	public function index(): View
	{
		// $query = User::query();

		// if ($request->filled('search')) {
		// 	$search = $request->input('search');
	
		// 	$query->where(function ($q) use ($search) {
		// 		$q->where('name', 'like', "%{$search}%")
		// 		  ->orWhere('email', 'like', "%{$search}%");
		// 	});
		// }
	
		// $users = $query->orderBy('name')->paginate(10);


		return view("users.index")
			->with("users", User::query()->withCount(["visits" => function (Builder $query) {
				$query->where("created_at", today());
			}])->get());
	}

	public function create(): View
	{
		return view("users.create")->with("user", new User());
	}

	public function store(UserRequest $request): RedirectResponse
	{
		User::query()->create([
			...$request->validated(),
			"password" => Hash::make("password"), // Default password, must be changed later
		]);

		return to_route("users.index")->with("success", "Utilisateur créé avec succès.");
	}

	public function show(User $user): View
	{
		return view("users.show")->with("user", $user);
	}

	public function edit(User $user): View
	{
		return view("users.edit")->with("user", $user);
	}

	public function update(UserRequest $request, User $user): RedirectResponse
	{
		$user->update($request->except("password"));
		return to_route("users.index")->with("success", "Données de l'utilisateur mises à jour.");
	}


	public function destroy(User $user): RedirectResponse
	{
		if ($user->visits()->exists()) {
			return back()->with("warning", "Impossible de supprimer l'utilisateur car il a des visites associées.");
		}

		if (Auth::user()->id === $user->id) {
			return back()->with("warning", "Vous ne pouvez pas supprimer votre propre compte.");
		}

		$user->delete();

		return to_route("users.index")->with("success", "Utilisateur supprimé avec succès.");
	}
}

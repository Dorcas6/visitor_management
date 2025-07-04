<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Vérifier si l'utilisateur est un locataire
        if (auth('tenants')->check()) {
            // dd("locataire"); 
            return to_route('tenants.dashboard');
        }
        
        // Si c'est un agent de sécurité
        if (auth('web')->check()) {
            // dd("agent");
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Redirection par défaut si aucun des cas ci-dessus
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Déterminer la garde active
        $guard = auth('tenants')->check() ? 'tenants' : 'web';
        
        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

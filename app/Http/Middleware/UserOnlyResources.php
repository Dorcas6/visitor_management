<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserOnlyResources
{

    public function handle(Request $request, Closure $next): Response
    {
        dd("Called");
        if (auth('tenants')->check()) {
            // session()->flash("error", "Accès non autorisé.");
            auth('tenants')->logout();
            return to_route("login")->with("error", "Accès non autorisé.");
            // abort(403);
        }
        return $next($request);
    }
}

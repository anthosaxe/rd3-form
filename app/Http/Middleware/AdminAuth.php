<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si les credentials admin existent dans la session
        if (!$request->session()->has('admin_logged_in')) {
            // Redirige vers la page de connexion ou autre page
            return redirect('/login'); // Redirige vers une route de connexion ou page d'accueil
        }

        return $next($request);
    }
}

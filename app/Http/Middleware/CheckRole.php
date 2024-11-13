<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        // Verifica si el usuario autenticado tiene el idrol adecuado
        if (Auth::check() && Auth::user()->idrol === $role) {
            return $next($request);
        }

        // Redirecciona si no tiene el rol adecuado
        return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}

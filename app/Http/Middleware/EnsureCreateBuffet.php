<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCreateBuffet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('buffet')) {
                if ($user->buffets->count() > 0) {
                    // adicionar o redirect para a página de planos
                    return $next($request);
                } else {
                    return redirect()->route('auth.buffet.store');
                }
            } else {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}

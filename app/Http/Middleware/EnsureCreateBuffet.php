<?php

namespace App\Http\Middleware;

use App\Models\Buffet;
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
                $count = $user->buffets->count();
                if ($count > 0) {
                    $buffets = Buffet::where('owner_id', $user->id)->with('buffet_subscriptions')->get();
                    $buffets_without_subscription = $buffets->filter(function($buffet) {
                        return $buffet->buffet_subscriptions->count() === 0;
                    });

                    if(count($buffets_without_subscription) !== 0) {
                        return redirect()->route('auth.buffet.select_subscription');
                    }

                    // redirecionar para o outro sistema aqui
                    return $next($request);
                }
                return redirect()->route('auth.buffet.store');
            }
            return $next($request);
        }

        return redirect()->route('login');
    }
}

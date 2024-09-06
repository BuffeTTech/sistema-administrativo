<?php

namespace App\Http\Middleware;

use App\Models\Buffet;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyBuffetsNotCreated
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
                $buffets = Buffet::where('owner_id', $user->id)->with('buffet_subscriptions')->get();
                $buffets_without_subscription = $buffets->filter(function($buffet) {
                    return $buffet->buffet_subscriptions->count() === 0;
                });
                if ($user->buffets->count() === 0 || count($buffets_without_subscription) !== 0) {
                    return $next($request);
                } else {
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return redirect()->route('login');
    }
}
